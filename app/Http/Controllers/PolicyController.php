<?php

namespace App\Http\Controllers;

use App\Models\CancelationPolicy;
use Illuminate\Foundation\Console\PolicyMakeCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;



class PolicyController extends Controller
{
    protected $userId;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            if(!empty($request->user())){
                if ($request->user()->user_type == User::Roles['Admin']){
//                if (empty(session()->get('user_id'))){
//                    return $next($request)->route('dashboard');
//                }
                    $this->userId = session()->get('user_id');
                }else{
                    $this->userId = $request->user()->id;
                }
            }

            return $next($request);
        });
    }
    //
    public function index(){
        $hotel = Hotel::where('user_id', $this->userId)->with('cancels')->firstOrFail();
        return Inertia::render('Hotel/Policy' , compact('hotel'));
    }

    public function update(Request $request){
        $request->validate([
            'cancels' => [ 'nullable','array'],
            'cancels.*.hour' => [ 'required','string'],
            'cancels.*.percent' => ['required', 'string'],
            'service_charge' => ['nullable','numeric'],
            'extra_bed_charge' => ['nullable','numeric'],
        ]);

        try {
            $hotel = Hotel::find($request->id);

            $hours = CancelationPolicy::where('hotel_id' , $hotel->id)->delete();


            DB::beginTransaction();
            if(empty($hotel)){
                throw new \Exception('Invalid Hotel information');
            }

            $hotelU = $hotel->update([
                'rules'=>!empty($request->rules)? $request->rules : null,
                'service_charge'=>!empty($request->service_charge)? $request->service_charge : null,
                'extra_bed_charge'=>!empty($request->extra_bed_charge)? $request->extra_bed_charge : null,
                'check_in_from'=>!empty($request->check_in_from)? $request->check_in_from: null,
                'check_in_to'=>!empty($request->check_in_to)? $request->check_in_to: null,
                'check_out_from'=>!empty($request->check_out_from)? $request->check_out_from: null,
                'check_out_to'=>!empty($request->check_out_to)? $request->check_out_to: null,
                'pet_policy'=>!empty($request->pet_policy)? $request->pet_policy: 0,
                'child_policy'=>!empty($request->child_policy)? $request->child_policy: 0,
            ]);

            if(!empty($hotelU)){
                if(!empty($request->cancels) && count($request->cancels) > 0){
                    foreach ($request->cancels as $cancel){
                        $policy = CancelationPolicy::where('hotel_id' , $hotel->id)->where('hour' , $cancel['hour'])->first();

                        if( $policy){
                            DB::rollBack();
                            $validator = Validator::make([], []);
                            $validator->errors()->add('cancelation_policy', 'Duplicate Hour Entry for cancelation policy!');
                            return back()->withErrors("Duplicate Hour Entry for cancelation policy!");
                        }

                        $hotel->cancels()->updateOrCreate([
                            'id'=>$cancel['id']
                        ], [
                            'hour'=>$cancel['hour'],
                            'percent'=>$cancel['percent'],
                        ]);
                    }
                }

                if(!empty($request->deleted_cancels) && count($request->deleted_cancels) > 0){
                    $hotel->cancels()->whereIn('id', $request->deleted_cancels)->delete();
                }

                DB::commit();
                return redirect()->back()->with('success', 'Hotel policy updated successfully');
            }
        }catch (\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
