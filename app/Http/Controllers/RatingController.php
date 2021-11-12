<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RatingController extends Controller
{
    public function index()
    {
        $reviews = auth()->user()->reviews()->with('booking', 'hotel')->latest()->get();
        return Inertia::render('User/Rating/RatingList', compact('reviews'));
    }

    public function create($booking_id)
    {
        $booking = auth()->user()->bookings()->where('id', $booking_id)->firstOrFail();
        $booking_id = $booking->id;
        return Inertia::render('User/Rating/AddRating', compact('booking_id'));
    }

    public function store(Request $request, $booking_id)
    {
        Validator::make($request->all(), [
            'hotel_rating' => ['required'],
            'review' => ['required', 'string'],
        ])->validate();

        try {
            DB::beginTransaction();

            $booking = Booking::where('id', $booking_id)->first();
            if (empty($booking)){
                throw new \Exception('Invalid Booking information');
            }
            $review = $booking->rating()->create([
                'hotel_id'=>$booking->hotel_id,
                'user_id'=>auth()->id(),
                'hotel_rating'=>$request->hotel_rating,
                'staff_rating'=>!empty($request->staff_rating)?$request->staff_rating: 0,
                'facility_rating'=>!empty($request->facility_rating)?$request->facility_rating: 0,
                'cleanliness_rating'=>!empty($request->cleanliness_rating)?$request->cleanliness_rating: 0,
                'comfort_rating'=>!empty($request->comfort_rating)?$request->comfort_rating: 0,
                'price_rating'=>!empty($request->price_rating)?$request->price_rating: 0,
                'location_rating'=>!empty($request->location_rating)?$request->location_rating: 0,
                'review'=>!empty($request->review)?$request->review: null,
            ]);

            if (!empty($review)){
                DB::commit();
                return redirect()->route('user.rating.index')->with('success', 'Thank you for your feedback.');
            }

            throw new \Exception('Invalid Rating information');
        }catch (QueryException $ex){
            DB::rollBack();
            return redirect()->back()->withErrors('Server not response. Try again later');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
