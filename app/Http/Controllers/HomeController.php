<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Cookie;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }


    public function dashboard(Request $request){
        $hotel_id = Cookie::get('hotel_id');
        if(!empty(auth()->user())){
            if(auth()->user()->user_type == User::Roles['Admin']){
                return Inertia::render('Dashboard');
            }elseif(auth()->user()->user_type == User::Roles['User']){
                if(!empty($hotel_id)){
                     Cookie::forget('hotel_id');
                    return redirect()->route('details',$hotel_id);
                }else{
                    return redirect('/');
                }
            } else{
                return redirect()->route('hotel.dashboard');
            }

        }
        return redirect()->route('login')->withErrors('Unauthorized. Please Login.');

    }

    public function hotel_dashboard()
    {
        $rating = auth()->user()->hotel->reviews()
            ->select(
                'created_at',
                DB::raw('COUNT(CASE WHEN hotel_rating > 0 THEN 1 END) as hotel_rating_count'),
                DB::raw('SUM(hotel_rating) as total_hotel_rating'),

                DB::raw('COUNT(CASE WHEN staff_rating > 0 THEN 1 END) as staff_rating_count'),
                DB::raw('SUM(staff_rating) as total_staff_rating'),

                DB::raw('COUNT(CASE WHEN facility_rating > 0 THEN 1 END) as facility_rating_count'),
                DB::raw('SUM(facility_rating) as total_facility_rating'),

                DB::raw('COUNT(CASE WHEN cleanliness_rating > 0 THEN 1 END) as cleanliness_rating_count'),
                DB::raw('SUM(cleanliness_rating) as total_cleanliness_rating'),

                DB::raw('COUNT(CASE WHEN comfort_rating > 0 THEN 1 END) as comfort_rating_count'),
                DB::raw('SUM(comfort_rating) as total_comfort_rating'),

                DB::raw('COUNT(CASE WHEN price_rating > 0 THEN 1 END) as price_rating_count'),
                DB::raw('SUM(price_rating) as total_price_rating'),

                DB::raw('COUNT(CASE WHEN location_rating > 0 THEN 1 END) as location_rating_count'),
                DB::raw('SUM(location_rating) as total_location_rating'),
                DB::raw('SUM(id) as total_rating'))
                ->first();
        return Inertia::render('Dashboard/HotelDashboard', compact('rating'));
    }

    public function hotel_favourite_list()
    {
        if (!empty(auth()->user())) {
            if (auth()->user()->user_type == User::Roles['User']) {
                $favourite_hotels = auth()->user()->favourite_hotels()->with('district')->latest()->get();
                return Inertia::render('User/FavouriteHotelList', compact('favourite_hotels'));
            }
        }
        return redirect()->route('index')->withErrors('You are not Authorize. Please Login as User');
    }


    public function booking_list()
    {
        $bookings = auth()->user()->bookings()->orderBy('check_in', 'asc')->with('hotel', 'rating')->get();
        return Inertia::render('User/BookingList',compact('bookings') );
    }

    public function booking_invoice($id)
    {
        $booking = auth()->user()->bookings()->where('id', $id)
            ->orWhere('invoice_no', $id)
            ->with('hotel', 'booked_rooms.room.beds', 'user')
            ->firstOrFail();
        return view('invoices.booking_invoice', compact('booking'));
    }
}
