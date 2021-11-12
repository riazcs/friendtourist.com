<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Favourite;
use App\Models\FavouriteArea;
use App\Models\LandMark;
use App\Models\Rating;
use App\Models\RoomSchedule;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use Carbon\Carbon;
class FrontendController extends Controller
{

    public function index(){
        $blogs = Blog::with('attachment')->get();
        if($blogs){
            foreach($blogs as $blog){
                $blog->description = Str::limit(strip_tags($blog->description),150);
            }
        }
        $areas = FavouriteArea::with('attachment')->get();
        $facebook = Settings::where('name', 'facebook')->first();
        $youtube = Settings::where('name', 'youtube')->first();
        $instagram = Settings::where('name', 'instagram')->first();
        return Inertia::render('Frontend/Home',
            compact('areas','blogs','facebook','youtube','instagram')
        );
    }

    public function search_hotels(Request $request)
    {
        $query = explode('?', $request->fullUrl())[1];
        $checkin = Carbon::parse($request->check_in)->format('Y-m-d');
        $checkout = Carbon::parse($request->check_out)->format('Y-m-d');
        $type = $request['area']['type'];
        $title = $request['area']['title'];
        $request->search_key = $title;
        $adult= $request->adult;
        $district = null;
        if($type == "district"){
            $district = District::searchBy($request)->first();
        }
        $orderBy = !empty($request->order_by)? $request->order_by : null;

        $child = $request->child;
        $rooms = $request->rooms;

        if( $request->exists('childAges') ){
            foreach ($request->childAges as $childAge){
                if($childAge > 5){
                    ++$adult;
                }
            }
        }
        $hotels = Hotel::query()
            ->when($type == "hotel" , function ($query) use($title){
                return $query->where('name' , $title);
            })->when($type == "area" , function ($query) use($title){
                return $query->where('area' , $title);
            })->when($district , function ($query) use($district){
                return $query->where('district_id' , $district->id);
            })->whereHas('schedules', function ($query) use ($adult , $checkin , $checkout, $rooms) {
                return $query->findSchedule($adult, $checkin, $checkout, $rooms);
            })->with(['attachment', 'district', 'schedule'=>function($query) use ($adult , $checkin , $checkout, $rooms, $orderBy){
                return $query
                    ->findSchedule($adult, $checkin, $checkout, $rooms)
                    ->with('room');
            }])->when( $orderBy == "lowest", function ($query) use ($adult , $checkin , $checkout, $rooms, $orderBy) {
                 return $query->orderBy(
                     RoomSchedule::select('bar_rate')
                         ->whereColumn('room_schedules.hotel_id', 'hotels.id')
                         ->findSchedule($adult, $checkin, $checkout, $rooms)
                         ->orderBy('bar_rate', 'asc')
                         ->take(1)
                 );
            })
            ->when( $orderBy == "highest", function ($query) use ($adult , $checkin , $checkout, $rooms, $orderBy) {
                return $query->orderByDesc(
                    RoomSchedule::select('bar_rate')
                        ->whereColumn('room_schedules.hotel_id', 'hotels.id')
                        ->findSchedule($adult, $checkin, $checkout, $rooms)
                        ->orderBy('bar_rate', 'asc')
                        ->take(1)
                );
            })->when( $orderBy == "star" , function ($query) {
                return $query->orderBy('no_of_star' , 'DESC');
            })->when( $orderBy == "review" , function ($query) {
                return $query->latest();
            })
            ->paginate();

//        dd($hotels);
        $filter = $request->all();
        session()->put('query', $query);
        $hotels = HotelResource::collection($hotels);
        return Inertia::render('Frontend/HotelList' , compact('hotels', 'filter' , 'query'));
    }

    public function details(Request $request, $id){

        session()->forget('checkout');
        $filter = $request->all();
        $rooms = $request->rooms;
        $checkin = Carbon::parse($request->check_in)->format('Y-m-d');
        $checkout = Carbon::parse($request->check_out)->format('Y-m-d');
        $adult = $request->adult;
        if ($request->exists('childAges')) {
            $childAges = $request->childAges;
            foreach ($childAges as $childAge) {
                if ($childAge > 5) {
                    ++$adult;
                }
            }
        }

        $hotel = Hotel::where('id', $id)
            ->whereHas('rooms', function($query) use ($adult, $checkin, $checkout, $rooms) {
                return $query->isActive()->findRooms($adult, $checkin, $checkout, $rooms);
            })
            ->with(['attachments','district', 'facilities' , 'landmarks' , 'cancels', 'faqs',
                'rooms'=>function($query) use ($adult, $checkin, $checkout, $rooms){
                    return $query->isActive()
                            ->findRooms($adult, $checkin, $checkout, $rooms)
                            ->with(['attachment', 'facilities', 'attachments', 'schedules'=>function($query)use ($adult, $checkin, $checkout, $rooms){
                                return $query->isActive()->findAvailableRooms($checkin, $checkout, $rooms)
                                    ->orderBy('bar_rate');
                            }])
                        ->isActive();
            }])
            ->first();


        $is_favourite = false;

        $rating = Rating::where('hotel_id', $hotel->id)
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
        if(!empty(auth()->user())){
            $favourite = Favourite::where('hotel_id',$id)->where('user_id',auth()->id())->first();
            if (!empty($favourite)){
                $is_favourite = true;
            }
        }
        $landmark= $hotel->landmarks()->where('type' , LandMark::Type['Landmark'])->orderBy('distance' , 'asc')->first();
        return Inertia::render('Frontend/HotelDetails' , compact('filter','hotel', 'landmark', 'is_favourite', 'rating'));
    }

    public function area_search(Request $request)
    {
        $hotels = Hotel::isActive()->where('name', 'LIKE', '%'.$request->search_key.'%')
            ->orderBy('name', 'asc')->get();

        $areas = Hotel::isActive()
            ->where('area', 'LIKE', '%'.$request->search_key.'%')
            ->with('district.division')
            ->distinct()
            ->get();

        $districts = District::searchBy($request)->orderBy('name', 'asc')->get();

        $result = [];

        foreach ($areas as $area){
            array_push($result, [
                'title'=>$area->area,
                'location'=>$area->district->name.','.$area->district->division->name,
                'type'=>'area'
            ]);
        }

        foreach ($hotels as $hotel){
            $location = !empty($hotel->area)?$hotel->area.',':'';
            array_push($result, [
                'title'=>$hotel->name,
                'location'=>$location.$hotel->district->name.','.$hotel->district->division->name,
                'type'=>'hotel'
            ]);
        }

        foreach ($districts as $district){
            array_push($result, [
                'title'=>$district->name,
                'location'=>$district->division->name,
                'type'=>'district'
            ]);
        }

        return response()->json([
            'status'=>200,
            'data'=>$result
        ]);
    }


    public function store_cart(Request $request)
    {
        try {
            if (empty($request->cart) && count($request->cart) <= 0){
                throw new \Exception('Please Select Room for checkout');
            }

            if(!empty(session()->get('checkout'))){
                session()->forget('checkout');
            }

            session()->put('checkout', $request->all());
            if(empty(session()->get('checkout'))){
                throw new \Exception('Something wrong. try again.');
            }

            return redirect()->route('checkout');
        }catch (\Exception $ex){
            return redirect()->back()->with('error', 'Something wrong. try again');
        }
    }
    public function checkout_page(Request $request)
    {
        if(empty(session()->get('checkout'))){
            return redirect()->route('index')->with('Please Search and add room first');
        }
        $checkout_data = session()->get('checkout');
        $total_charge = $total_discount = $total_price = $rack_total = 0;

        $checkIn = Carbon::parse($checkout_data['check_in'])->format('Y-m-d');
        $checkOut = Carbon::parse($checkout_data['check_out'])->format('Y-m-d');

        $nights = Carbon::parse($checkout_data['check_out'])->diffInDays(Carbon::parse($checkout_data['check_in']));
        $hotel = Hotel::where('id', $checkout_data['hotel_id'])->with('attachment', 'district')->firstOrFail();


        foreach ($checkout_data['cart'] as $key =>$item){
            $room = $item['room'];
            $schedule = RoomSchedule::where('id', $item['schedule_id'])
                ->reCheckSchedule($checkIn,$checkOut,$room)->first();
            if(empty($schedule)){
                return redirect("/details/{$checkout_data['hotel_id']}?".session()->get('query'))->withErrors('Ops! Some of your room already booked by other');
            }
            $total_charge += $schedule->total_charge * $item['room'];
            $total_discount += ($schedule->discount_percent / count($checkout_data['cart']));
            $total_price += $schedule->bar_rate * $item['room'];
            $rack_total += $schedule->room->rack_price * $item['room'];
        }

        $coupons = Coupon::isActive()->whereDate('start_date', '<=', today())->whereDate('end_date', '>=', today())->get();
        $convenience_percent = Booking::Convenience_percent;

        return Inertia::render('Frontend/CheckoutPage', compact(
            'checkout_data',
            'nights',
            'hotel',
            'total_charge',
            'total_discount',
            'total_price',
            'rack_total',
            'coupons',
            'convenience_percent'
        ));
    }

    public function get_policy($type){
        $policy='';
        if ($type == 'refund_policy') {
            $policy = Settings::where('name', 'refund_policy')->first();
        }
        elseif ($type == 'emi_policy'){
            $policy = Settings::where('name', 'emi_policy')->first();
        }
        elseif ($type == 'career'){
            $policy = Settings::where('name', 'career')->first();
        } elseif ($type == 'terms'){
            $policy = Settings::where('name', 'terms')->first();
        }
        else{
            $policy = Settings::where('name', 'privacy_policy')->first();
        }
        return Inertia::render('Frontend/Policy',compact('policy'));
    }
}
