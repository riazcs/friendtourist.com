<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Jobs\BookingStatusUpdateJob;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class HotelReservationController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->range)){
            $filter_data['range']=$request->range;
        }else{
            $range=[
                'start'=>today()->format('d-m-Y'),
                'end'=>Carbon::today()->addDays(15)->format('d-m-Y')
            ];
            $filter_data['range']=$range;
            $request->range=$range;
        }

        $hotel = Hotel::where('user_id', auth()->id())->with('bookings')->firstOrFail();
        $reservations = $hotel->bookings()->where('payment_status', Booking::PaymentStatus['Complete'])
            ->searchBy($request)->with('user')
            ->get();

        $reservations = BookingResource::collection($reservations);
        return Inertia::render('Reservation/ReservationList', compact('reservations', 'filter_data'));
    }

    public function booking_status_update(Request $request)
    {
        Validator::make($request->all(), [
            'booking_id' => ['required'],
            'status' => ['required']
        ],[
            'booking_id.required'=>'Invalid booking information',
            'status.required'=>'Invalid booking status information',
        ])->validate();

        try {
            DB::beginTransaction();
            $message = 'Booking status updated successfully';

            $booking = auth()->user()->hotel->bookings()
                ->where('id', $request->booking_id);
            if ($request->status == Booking::Status['CheckIn']){
                $booking= $booking->whereIn('status', [Booking::Status['Complete'], Booking::Status['Pending']]);
                $message = 'Your Guest Check in successfully';
            }
            if ($request->status == Booking::Status['CheckOut']){
                $booking= $booking->where('status', Booking::Status['CheckIn']);
                $message = 'Your Guest Check out successfully';
            }
            $booking = $booking->first();
            if (empty($booking)){
                throw new \Exception('Invalid Booking information');
            }
            $bookingU = $booking->update([
                'status'=> $request->status,
            ]);
            if (!empty($bookingU)){
                dispatch(new BookingStatusUpdateJob($booking, $message));
                DB::commit();
                return redirect()->route('hotel.reservation.index')->with('success', $message);
            }
            throw new \Exception('Something Wrong. Try again');
        }catch (QueryException $ex){
            DB::rollBack();
            return redirect()->back()->withErrors('Server not response. Please Try again');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function booking_invoice($id)
    {
        $booking = auth()->user()->hotel->bookings()->where('id', $id)
            ->orWhere('invoice_no', $id)
            ->with('hotel', 'booked_rooms.room.beds', 'user')
            ->firstOrFail();
        return view('invoices.booking_invoice', compact('booking'));
    }
}
