<?php

namespace App\Http\Controllers;

use App\Jobs\NewBookingPlaceJob;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\RoomSchedule;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SslCommerzPaymentController extends Controller
{

    public function payViaAjax(Request $request)
    {

        try {
            DB::beginTransaction();

            if(empty(session()->get('checkout'))){
                throw new \Exception('Please Search and add room first');
            }

            $cart_json = json_decode($request->cart_json);

//            dd($cart_json['guests']);
            if (empty($cart_json) || empty($cart_json->guests)){
                throw new \Exception('Please provide all guest information');
            }

            $checkout_data = session()->get('checkout');
            $total_charge = $total_discount = $total_price = $rack_total = $total_room = 0;

            $checkIn = Carbon::parse($checkout_data['check_in'])->format('Y-m-d');
            $checkOut = Carbon::parse($checkout_data['check_out'])->format('Y-m-d');
            $hotel = Hotel::where('id', $checkout_data['hotel_id'])->with('attachment', 'district')->firstOrFail();

            foreach ($checkout_data['cart'] as $key =>$item){
                $room = $item['room'];
                $total_room += $room;

                $schedule = RoomSchedule::where('id', $item['schedule_id'])
                    ->reCheckSchedule($checkIn,$checkOut,$room)->first();
                if(empty($schedule)){
                    throw new \Exception('Ops! Some of your room already booked by other');
                }
                $total_charge += $schedule->total_charge * $item['room'];
                $total_discount += ($schedule->discount_percent / count($checkout_data['cart']));
                $total_price += $schedule->bar_rate * $item['room'];
                $rack_total += $schedule->room->rack_price * $item['room'];
            }
            $total_amount = $total_charge + $total_price;

            $coupon_discount = 0;
            if (empty($cart_json->coupon_id)){
                $coupon = Coupon::where('id', $cart_json->coupon_id)->first();
                if(!empty($coupon)){
                    if($coupon->discount_type == Coupon::TYPES['Percent']){
                        $coupon_discount = $total_amount *($coupon->coupon_value/100);
                    }else{
                        $coupon_discount = $coupon->coupon_value;
                    }

                    if($coupon_discount > $coupon->max_limit){
                        $coupon_discount = $coupon->max_limit;
                    }
                }
            }

            $total_amount = $total_amount - $coupon_discount;

            $convenience_fee = $total_amount * Booking::Convenience_percent;
            $total_amount = $total_amount + $convenience_fee;

            $total_save = ($rack_total - $total_price) +$coupon_discount;

            $tran_id = 'FT'.Carbon::now()->format('dmYHis').Booking::generate_random_id(6);

            $booking = Booking::create([
                'invoice_no'=> 'FT'.Carbon::now()->format('dmyHi').Booking::generate_random_id(4),
                'user_id'=>auth()->id(),
                'hotel_id'=>$hotel->id,
                'total_room'=> $total_room,
                'adult'=>$checkout_data['adult'],
                'child'=>$checkout_data['child'],
                'check_in'=>$checkIn,
                'check_out'=>$checkOut,
                'rack_total'=>(int)$rack_total,
                'hotel_discount'=>(int)$total_discount, //percent ve
                'sub_total' => (int)$total_price,
                'total_charge'=>(int)$total_charge,
                'coupon_id'=>!empty($cart_json->coupon_id)? $cart_json->coupon_id : null,
                'coupon_discount'=>(int)$coupon_discount,
                'convenience_fee'=> (int)$convenience_fee,
                'total_amount'=>(int)$total_amount,
                'total_save'=>(int)$total_save,
                'transaction_id'=>$tran_id,
                'currency'=> Booking::Currency,
                'status'=>Booking::Status['Pending'],
                'payment_status'=>Booking::PaymentStatus['Pending'],
                'payment_method'=>Booking::Method
            ]);

            if (!empty($booking)){
                $roomArray = [];
                foreach ($checkout_data['cart'] as $key =>$item){
                    $schedule = RoomSchedule::where('id', $item['schedule_id'])->first();
                    array_push($roomArray, [
                        'booking_id'=>$booking->id,
                        'room_id'=>$item['room_id'],
                        'schedule_id'=>$item['schedule_id'],
                        'rack_price'=>$schedule->room->rack_price,
                        'bar_price'=>$schedule->bar_rate,
                        'room_name'=>$item['room_name'],
                        'room_qty'=>$item['room'],
                        'room_amenities'=> !empty($schedule->room->facilities()->pluck('name'))? json_encode($schedule->room->facilities()->pluck('name'), true): json_encode([]),
                    ]);
                }

                if (empty($roomArray) || count($roomArray) <=0){
                    throw new \Exception('Invalid Room details');
                }
                $bookedRoom = $booking->booked_rooms()->insert($roomArray);
                if(!empty($bookedRoom)){
                    $guestArray = [];
                    foreach ($cart_json->guests as $guest){
                        array_push($guestArray, [
                            'guest_name'=>$guest,
                            'booking_id'=>$booking->id,
                        ]);
                    }
                    if (empty($guestArray) || count($guestArray) <= 0){
                        throw new \Exception('Invalid Guest details');
                    }
                    $guestInfo = $booking->guests()->insert($guestArray);

                    if(!empty($guestInfo)){
                        DB::commit();
                        $paymentData = Booking::ssl_commerz_post_array($booking->total_amount, $tran_id, $hotel->name);
                        $sslc = new SslCommerzNotification();
                        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                        $payment_options = $sslc->makePayment($paymentData, 'checkout', 'json');

                        if (!is_array($payment_options)) {
                            print_r($payment_options);
                            $payment_options = array();
                        }
                    }else{
                        throw new \Exception('Invalid Guest Information');
                    }

                }else{
                    throw new \Exception('Invalid Room Information');
                }

            }else{
                throw new \Exception('Invalid Booking Information');
            }


        }catch (QueryException $qEx){
            DB::rollBack();
            dd($qEx->getMessage());
            return redirect()->back()->withErrors('Something very Wrong. Try again')->withInput();
        }catch (\Exception $ex){
            DB::rollBack();
            dd($ex->getMessage());
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }


    public function success(Request $request)
    {
        try {
            DB::beginTransaction();
            $booking = Booking::where('transaction_id', $request->input('tran_id'))->first();
            Auth::loginUsingId($booking->user_id);

            if ($booking->payment_status == Booking::PaymentStatus['Pending']) {
                $tran_id = $request->input('tran_id');
                $amount = $request->input('amount');
                $currency = $request->input('currency');

                $sslc = new SslCommerzNotification();

                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

                if ($validation == TRUE) {
                    $booking->update([
                        'status'=>Booking::Status['Complete'],
                        'payment_status'=>Booking::PaymentStatus['Complete']
                    ]);
                    dispatch(new NewBookingPlaceJob($booking));
                    DB::commit();
                    return redirect()->route('user.booking.list')->withSuccess('Transaction is successfully Completed');
                } else {
                    $booking->update([
                        'status'=>Booking::Status['Canceled'],
                        'payment_status'=>Booking::PaymentStatus['Fail']
                    ]);
                    $booking->guest()->delete();
                    $booking->booked_rooms()->delete();
                    $booking->delete();
                    DB::commit();
                    return redirect()->route('index')->withSuccess('Transaction is failed. Try again');
                }
            } else if ($booking->payment_status == Booking::PaymentStatus['Complete']) {
                DB::commit();
                return redirect()->route('user.booking.list')->withSuccess('Transaction is successfully Completed');
            } else {
                throw new \Exception('Invalid Transaction. Try again');
            }

        }catch (QueryException $qEx){
            DB::rollBack();
            return redirect()->route('index')->withErrors('Something very Wrong. Try again')->withInput();
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index')->withErrors($ex->getMessage())->withInput();
        }
    }

    public function fail(Request $request)
    {

        try{
            DB::beginTransaction();
            $booking = Booking::where('transaction_id', $request->input('tran_id'))->first();

            Auth::loginUsingId($booking->user_id);

            if ($booking->payment_status == Booking::PaymentStatus['Pending']) {

                $booking->update([
                    'status'=>Booking::Status['Canceled'],
                    'payment_status'=>Booking::PaymentStatus['Fail']
                ]);

                $booking->guests()->delete();
                $booking->booked_rooms()->delete();
                $booking->delete();
                DB::commit();
                return redirect()->route('index')->withSuccess('Transaction is failed. Try again');

            } else if ($booking->payment_status == Booking::PaymentStatus['Complete']) {
                DB::commit();
                return redirect()->route('user.booking.list')->withSuccess('Transaction is already successfully completed');
            } else {
                throw new \Exception('Invalid Transaction. Try again');
            }

        }catch (QueryException $qEx){
            DB::rollBack();
            return redirect()->route('index')->withErrors('Something very Wrong. Try again')->withInput();
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index')->withErrors($ex->getMessage())->withInput();
        }
    }

    public function cancel(Request $request)
    {
        try{
            DB::beginTransaction();
            $booking = Booking::where('transaction_id', $request->input('tran_id'))->first();
            Auth::loginUsingId($booking->user_id);

            if ($booking->payment_status == Booking::PaymentStatus['Pending']) {
                $booking->update([
                    'status'=>Booking::Status['Canceled'],
                    'payment_status'=>Booking::PaymentStatus['Canceled']
                ]);
                $booking->guests()->delete();
                $booking->booked_rooms()->delete();
                $booking->delete();
                DB::commit();
                return redirect()->route('index')->withSuccess('Transaction is cancel. Try again');

            } else if ($booking->payment_status == Booking::PaymentStatus['Complete']) {
                DB::commit();
                return redirect()->route('user.booking.list')->withSuccess('Transaction is already successfully completed');
            } else {
                throw new \Exception('Invalid Transaction. Try again');
            }

        }catch (QueryException $qEx){
            DB::rollBack();
            return redirect()->route('index')->withErrors('Something very Wrong. Try again')->withInput();
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index')->withErrors($ex->getMessage())->withInput();
        }
    }

    public function ipn(Request $request)
    {

        try {
            DB::beginTransaction();
            if(empty($request->input('tran_id'))){
                throw new \Exception('Invalid Transaction data. Try again');
            }
            $booking = Booking::where('transaction_id', $request->input('tran_id'))->first();
            Auth::loginUsingId($booking->user_id);
            if ($booking->payment_status == Booking::PaymentStatus['Pending']) {
                $tran_id = $request->input('tran_id');
                $amount = $request->input('amount');
                $currency = $request->input('currency');

                $sslc = new SslCommerzNotification();

                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

                if ($validation == TRUE) {
                    $booking->update([
                        'status'=>Booking::Status['Complete'],
                        'payment_status'=>Booking::PaymentStatus['Complete']
                    ]);
                    dispatch(new NewBookingPlaceJob($booking->fresh()));
                    DB::commit();
                    return redirect()->route('user.booking.list')->withSuccess('Transaction is successfully Completed');
                } else {
                    $booking->update([
                        'status'=>Booking::Status['Canceled'],
                        'payment_status'=>Booking::PaymentStatus['Fail']
                    ]);
                    $booking->guests()->delete();
                    $booking->booked_rooms()->delete();
                    $booking->delete();
                    DB::commit();
                    return redirect()->route('index')->withSuccess('Transaction is failed. Try again');
                }
            } else if ($booking->payment_status == Booking::PaymentStatus['Complete']) {
                DB::commit();
                return redirect()->route('user.booking.list')->withSuccess('Transaction is successfully Completed');
            } else {
                throw new \Exception('Invalid Transaction. Try again');
            }

        }catch (QueryException $qEx){
            DB::rollBack();
            return redirect()->route('index')->withErrors('Something very Wrong. Try again')->withInput();
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index')->withErrors($ex->getMessage())->withInput();
        }
    }

}
