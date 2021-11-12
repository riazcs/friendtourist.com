<?php

namespace App\Http\Controllers;

use App\Jobs\SendOTPSMSJob;
use App\Models\Favourite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function send_otp(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        $user = User::where( 'phone' , $request->phone )->first();
        if($user && auth()->user()->phone != $request->phone){
            return back()->withErrors("Number Already Exists!");
        }
        $user = Auth::user();
        try {
            DB::beginTransaction();
            $otp = mt_rand(11111, 99999);
            $text = "Your OTP from ". config('app.name') . ": " . $otp . ". Don't share it with others";
            $mask = "NOMASK";
            $phone = $request->phone;
            dispatch(new SendOTPSMSJob($mask , $phone, $text));

            if ( !empty($user) && $user->can_verified_after <= Carbon::now() ) {

                $update_user = $user->update([
                    'phone' => $request->phone,
                    'otp' =>  $otp,
                    'attempt' => 0,
                    'can_verified_after' => Carbon::now()->addMinutes(2)
                ]);
                if (!empty($update_user)) {
                    DB::commit();
                    return redirect()->route('verification');
                } else {
                    DB::rollBack();
                    return back()->withErrors("Something Errors!");
                }
            }else{
                DB::rollBack();
                return back()->withErrors("You wont be sent it again in 2 minutes!");
            }

        } catch (\Exception $ex) {
            return back()->withErrors("Something Wrong!");

        }
    }
    public function otp_verification(){
        return Inertia::render('Auth/OtpVerification');
    }

    public function resend_otp(){
        $user = auth()->user();
        if($user && $user->can_verified_after <= Carbon::now()){
            $otp = mt_rand(11111, 99999);
            $user->otp = $otp;
            $user->attempt = 0;
            $user->can_verified_after = Carbon::now()->addMinutes(2);
            $user->update();

            $text = "Your OTP from ". config('app.name') . ": " . $otp . ". Don't share it with others";
            dispatch(new SendOTPSMSJob("NOMASK" , $user->phone, $text));
            return response()->json(["key" => "success"]);
        }
        else {
            return response()->json(["key" => "Wait 2 Minutes before sent again"]);
        }
    }

    public function match_otp(Request $request){
        try {
            DB::beginTransaction();

            $user = auth()->user();
            if($user->attempt >= 5) {
                throw new \Exception('Maximum attempt Done! Resend OTP again!');
            }
            if($user->otp != $request->otp){
                $user->attempt =  $user->attempt + 1;
                $user->update();
                DB::commit();
                return redirect()->back()->withErrors("OTP Not Matched!");
            }else if( $user->otp == $request->otp ) {
                $user->attempt = 0;
                $user->phone_verified_at = Carbon::now();
                $user->update();
                DB::commit();
                if(!empty(session()->get('checkout'))){
                    return redirect()->route('checkout')->withSuccess("Account verification is complete");
                }
                return redirect()->route('index')->withSuccess("Account verification is complete");
            }
            throw new \Exception('OTP Not Matched! Try again later');
        }catch (QueryException $ex){
            DB::rollBack();
            return redirect()->back()->withErrors('Something very Wrong try again');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function make_favourite(Request $request,$user_id){
        $this->validate($request, [
            'hotel_id' => 'required'
        ]);
        Session::put('hotel_id',$request->hotel_id);
        Cookie::queue('hotel_id', $request->hotel_id, 10);
        try {
            DB::beginTransaction();
            if(empty($user_id)){
                return redirect()->route('login')->with('hotel_id',$request->hotel_id);
            }
            $favourite = Favourite::where('hotel_id',$request->hotel_id)->where('user_id',$user_id)->first();
            if(!empty( $favourite)){
                throw new \Exception('Failed!');
            }
            $save_data = Favourite::create([
                'hotel_id' => $request->hotel_id,
                'user_id' => $user_id,
            ]);
            if (!empty($save_data)) {
                DB::commit();
                return back();
            } else {
                throw new \Exception('Failed!');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }


    public function make_un_favourite(Request $request,$hotelId){
//        $this->validate($request, [
//            $hotelId => 'required'
//        ]);
        try {
            DB::beginTransaction();
            if (!empty(auth()->user())){
                $favourite = Favourite::where('hotel_id',$hotelId)->where('user_id',auth()->user()->id)->first();
            }
            if(empty($favourite)){
                throw new \Exception('Failed!');
            }else{
                if($favourite->delete()) {
                    DB::commit();
                    return back();
                } else {
                    throw new \Exception('Failed!');
                }
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

}
