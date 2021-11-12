<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Setting/Coupon',[
            'coupons' => Coupon::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon_code' => 'required',
            'coupon_value' => 'required',
            'discount_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $save_data = Coupon::create([
                'host_id' => $request->host_id,
                'coupon_code' => $request->coupon_code,
                'coupon_value' => $request->coupon_value,
                'max_limit' => $request->max_limit,
                'discount_type' => $request->discount_type,
                'minimum_order_value' => $request->minimum_order_value,
                'status' => $request->status,
                'start_date' =>Carbon::parse( $request->start_date)->format('Y-m-d'),
                'end_date' =>Carbon::parse( $request->end_date)->format('Y-m-d'),
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        if (empty($coupon)) {
            throw new \Exception('Failed!');
        }
        $this->validate($request, [
            'coupon_code' =>  'required',
        ]);
        try {
            $update_data = $coupon->update([
                'host_id' => $request->host_id,
                'coupon_code' => $request->coupon_code,
                'coupon_value' => $request->coupon_value,
                'max_limit' => $request->max_limit,
                'discount_type' => $request->discount_type,
                'minimum_order_value' => $request->minimum_order_value,
                'status' => $request->status,
                'start_date' => Carbon::parse( $request->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse( $request->end_date)->format('Y-m-d'),
            ]);
            if (!empty($update_data)) {
                DB::commit();
                return back();
            } else {
                throw new \Exception('Failed!');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $coupon = Coupon::find($id);
            if (empty($coupon)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $coupon->delete();
            if (!empty($delete_data)) {
                DB::commit();
                return back();
            } else {
                throw new \Exception('Failed!');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage())->withInput();
        }
    }
}
