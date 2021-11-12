<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\District;
use App\Models\Hotel;
use App\Models\LandMark;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class HotelManagementController extends Controller
{
    protected $userId;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!empty($request->user())) {
                if ($request->user()->user_type == User::Roles['Admin']) {
                    //                if (empty(session()->get('hotel_user_id'))){
                    //                    return $next($request)->route('dashboard');
                    //                }
                    $this->userId = session()->get('hotel_user_id');
                } else {
                    $this->userId = $request->user()->id;
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        return Inertia::render('Dashboard/Hotels', [
            'districts' => District::where('status', 1)->get(),
            'hotels' => User::where('user_type', User::Roles['Hotel Admin'])->with('hotel.district')->orderBy('created_at', 'Desc')->get(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|max:255',
            'district_id' => 'required',
            'hotel_admin_name' => 'required',
            'designation' => 'required',
            'phone' => 'required|unique:users,phone',
            'nid' => 'required|numeric',
            'dob' => 'required',
            'license' => 'required|unique:hotels,license',
            'password' => 'required|confirmed|min:8',
            'email' => 'required|email|unique:users,email',
            'status' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request['hotel_admin_name'],
                'email' => $request['email'],
                'designation' => $request['designation'],
                'nid' => $request['nid'],
                'dob' => $request['dob'],
                'phone' => $request['phone'],
                'password' => bcrypt($request['password']),
                'user_type' => User::Roles['Hotel Admin']
            ]);
            if (!empty($user)) {
                $hotel = $user->hotel()->create([
                    'name' => $request['hotel_name'],
                    'license' => $request['license'],
                    'status' => $request['status'],
                    'district_id' => $request['district_id'],
                    'user_id' => $user->id,
                ]);

                if (!empty($hotel)) {
                    DB::commit();
                    return back();
                }
                throw new \Exception('Invalid Hotel Information');
            }
            throw new \Exception('Invalid Hotel Admin Information');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function my_hotel_details()
    {
        $hotel = Hotel::where('user_id', $this->userId)->with('landmarks', 'district')->firstOrFail();
        $districts =  District::where('status' , 1)->get();
        // ## TODO declare const
        //$propertyTypes = Settings::where('name' , Setting::SettingTypes['property_type'])->get();
        $propertyTypes = Settings::where('name' , "property_type")->get();
        return Inertia::render('Hotel/MyHotel', ['hotel' => $hotel , 'districts' => $districts , 'propertyTypes' => $propertyTypes ]);
    }

    public function update_hotel_info(Request $request, $id)
    {
        $request->validate([
            'rules' => ['string'],
            'contact_last_name' => ['required', 'string'],
            'contact_email' => ['required', 'string'],
            'contact_phone' => ['required', 'string'],

            'area' => ['required', 'string'],

            'landmarks' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();
            $hotel = Hotel::find($id);
            if (empty($hotel)) {
                throw new \Exception('Invalid Hotel information');
            }
            $hotelU = $hotel->update([
                'property_type' => $request->property_type,
                'no_of_rooms' => $request->no_of_rooms,
                'no_of_floors' => $request->no_of_floors,
                'construction_year' => !empty($request->construction_year) ? $request->construction_year : null,

                'website' => !empty($request->website) ? $request->website : null,
                'contact_first_name' => $request->contact_first_name,
                'contact_last_name' => !empty($request->contact_last_name) ? $request->contact_last_name : null,
                'contact_email' => !empty($request->contact_email) ? $request->contact_email : null,
                'contact_phone' => !empty($request->contact_phone) ? $request->contact_phone : null,
                'contact_designation' => !empty($request->contact_designation) ? $request->contact_designation : null,
                'contact_department_name' => !empty($request->contact_department_name) ? $request->contact_department_name : null,
                'address_line' => !empty($request->address_line) ? $request->address_line : null,
                'area' => !empty($request->area) ? $request->area : null,
                'lon' => !empty($request->lon) ? $request->lon : null,
                'lat' => !empty($request->lat) ? $request->lat : null,
                'description' => !empty($request->description) ? $request->description : null,
                'no_of_star' => $request->no_of_star,

            ]);

            if (!empty($hotelU)) {
                if (!empty($request->landmarks) && count($request->landmarks) > 0) {
                    foreach ($request->landmarks as $landmark) {
                        $hotel->landmarks()->updateOrCreate([
                            'id' => $landmark['id']
                        ], [
                            'type' => $landmark['type'],
                            'distance' => $landmark['distance'],
                            'name' => $landmark['name']
                        ]);
                    }
                }

                if(!empty($request->deleted_landmarks) && count($request->deleted_landmarks) > 0){
                    $hotel->landmarks()->whereIn('id', $request->deleted_landmarks)->delete();
                }

                DB::commit();
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::commit();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|max:255',
            'district_id' => 'required',
            'hotel_admin_name' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'nid' => 'required|numeric',
            'dob' => 'required',
            'license' => 'required',
            'password' => 'nullable|confirmed',
            'email' => 'email',
            'status' => 'required',
        ]);

        $user = User::find($request->id);
        $user->name = $request['hotel_admin_name'];
        $user->email = $request['email'];
        $user->designation = $request['designation'];
        $user->nid = $request['nid'];
        $user->dob = $request['dob'];
        $user->phone = $request['phone'];
        if (!empty($request->password)) {
            $user->password = bcrypt($request['password']);
        }
        $user->update();

        $hotel = Hotel::find($user->hotel->id);
        $hotel->name = $request['hotel_name'];
        $hotel->license = $request['license'];
        $hotel->status = $request['status'];
        $hotel->district_id = $request['district_id'];
        $hotel->user_id = $user->id;
        $hotel->update();
        return back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return back();
    }


    public function hotel_amenities(){
        $amenities = Amenity::where('type', Amenity::AmenityTypes['Hotel'])
            ->where('parent_id', null)
            ->has('children')->with('children')->get();
        $myAmenities = Hotel::where('user_id' , $this->userId)->with('facilities')->first();
        $myAmenities = $myAmenities->facilities()->pluck('amenity_id');
        return Inertia::render('Hotel/HotelAmenity', compact('amenities', 'myAmenities'));
    }

    public function hotel_amenities_store(Request $request){
        Validator::make($request->all(), [
            'amenity_ids' => ['required','array', 'min:1']
        ])->validate();

        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->first();
            if (empty($hotel)) {
                throw new \Exception('Invalid Hotel information');
            }

            $amenity = $hotel->facilities()->sync($request->amenity_ids);
            if(!empty($amenity)){
                DB::commit();
                return redirect()->back()->with('success', 'Hotel amenity updated successfully');
            }
            throw new \Exception('Invalid amenity information selected');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function get_hotel_room_id($id){
        $result = '';
        $room_id = '';
        $hotel = Hotel::where('user_id' , $this->userId)->with('rooms')->first();
        if(!empty($hotel) || $hotel->rooms){
            $result = $hotel;
            $room = $hotel->rooms->first();
            if(!empty($room)){
                $room_id = $room->id;            }
        }
        return  response()->json(['result'=>$result,'room_id'=>$room_id]);
    }
}
