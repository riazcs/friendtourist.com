<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomBed;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class HotelRoomController extends Controller
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

    public function index(Request $request)
    {
        $hotel = Hotel::where('user_id', $this->userId)->with('rooms')->first();
        $rooms = $hotel->rooms()->with('beds', 'facilities')->latest()->paginate(3);
        $rooms = RoomResource::collection($rooms);
        $amenities = Amenity::where('type', Amenity::AmenityTypes['Room'])
            ->where('parent_id', null)
            ->has('children')->with('children')->get();
        return Inertia::render('Room/HotelRooms', compact('rooms', 'amenities'));
    }

    public function create()
    {
        $roomTypes = Settings::where('name', Settings::SettingTypes['Room Type'])->pluck('data');
        $characteristics = Settings::where('name', Settings::SettingTypes['Room Characteristics'])->pluck('data');
        $room_views = Settings::where('name', Settings::SettingTypes['Room View'])->pluck('data');
        $bed_types = Settings::where('name', Settings::SettingTypes['Bed Type'])->pluck('data');
        $bed_sizes = Settings::where('name', Settings::SettingTypes['Bed Size'])->pluck('data');
        return Inertia::render('Room/CreateUpdateHotelRoom', compact(
            'roomTypes',
            'characteristics',
            'room_views',
            'bed_types',
            'bed_sizes'
            ));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'room_type' => ['required','string'],
            'room_name'=>[Rule::requiredIf(empty($request->room_character))],
            'beds' => ['required', 'array', 'min:1'],
            'beds.*.bed_type' => ['required', 'string'],
            'beds.*.bed_size' => ['nullable', 'string'],
            'rack_price' => ['required', 'numeric', 'min:0', 'not_in:0'],
        ])->validate();

        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->first();
            if (empty($hotel)){
                throw new \Exception('Invalid Hotel information');
            }
            $room = $hotel->rooms()->create([
                'room_type'=>$request->room_type,
                'room_character'=>!empty($request->room_character)?$request->room_character:null,
                'room_view'=>!empty($request->room_view)?$request->room_view: null,
                'room_name'=>!empty($request->room_name)? $request->room_name: $request->room_character,
                'smoking_policy'=>!empty($request->smoking_policy)? $request->smoking_policy: 0,
                'total_rooms'=>!empty($request->total_rooms)?$request->total_rooms: 1,
                'adult_occupancy'=>!empty($request->adult_occupancy)?$request->adult_occupancy: 1,
                'child_occupancy'=>!empty($request->child_occupancy)?$request->child_occupancy: 0,
                'extra_bed'=>!empty($request->extra_bed)? $request->extra_bed: 0,
                'max_guest_allow'=>!empty($request->max_guest_allow)? $request->max_guest_allow: 0,
                'room_size'=>!empty($request->room_size)?$request->room_size: null,
                'rack_price'=>$request->rack_price,
                'status'=>config('app.status.active')
            ]);

            if (!empty($room)){
                if(!empty($request->beds) && count($request->beds) > 0){
                    $beds = [];
                    foreach ($request->beds as $bed){
                        array_push($beds, [
//                            'room_id'=>$room->id,
                            'bed_type'=>$bed['bed_type'],
                            'bed_size'=>$bed['bed_size'],
                        ]);
                    }

                    if(!empty($beds) && count($beds) > 0){
                        $room->beds()->createMany($beds);
                    }
                }

                DB::commit();
                return redirect()->route('hotel.rooms.index')->with('success', 'New room added successfully');
            }

            throw new \Exception('Invalid room information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $room = Room::where('id', $id)->with('beds')->firstOrFail();
        $roomTypes = Settings::where('name', Settings::SettingTypes['Room Type'])->pluck('data');
        $characteristics = Settings::where('name', Settings::SettingTypes['Room Type'])->pluck('data');
        $room_views = Settings::where('name', Settings::SettingTypes['Room Type'])->pluck('data');
        $bed_types = Settings::where('name', Settings::SettingTypes['Bed Type'])->pluck('data');
        $bed_sizes = Settings::where('name', Settings::SettingTypes['Bed Size'])->pluck('data');
        return Inertia::render('Room/CreateUpdateHotelRoom', compact(
            'roomTypes',
            'characteristics',
            'room_views',
            'bed_types',
            'bed_sizes',
            'room'
        ));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'room_type' => ['required','string'],
            'room_name'=>[Rule::requiredIf(empty($request->room_character))],
            'beds' => ['required', 'array', 'min:1'],
            'beds.*.bed_type' => ['required', 'string'],
            'beds.*.bed_size' => ['nullable', 'string'],
            'rack_price' => ['required', 'numeric', 'min:0', 'not_in:0'],
        ])->validate();

        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->first();
            if (empty($hotel)){
                throw new \Exception('Invalid Hotel information');
            }

            $room = $hotel->rooms()->where('id', $id)->first();
            if (empty($room)){
                throw new \Exception('Invalid Room information');
            }

            $roomU = $room->update([
                'room_type'=>$request->room_type,
                'room_character'=>!empty($request->room_character)?$request->room_character:null,
                'room_view'=>!empty($request->room_view)?$request->room_view: null,
                'room_name'=>!empty($request->room_name)? $request->room_name: $request->room_character,
                'smoking_policy'=>!empty($request->smoking_policy)? $request->smoking_policy: 0,
                'total_rooms'=>!empty($request->total_rooms)?$request->total_rooms: 1,
                'adult_occupancy'=>!empty($request->adult_occupancy)?$request->adult_occupancy: 1,
                'child_occupancy'=>!empty($request->child_occupancy)?$request->child_occupancy: 0,
                'extra_bed'=>!empty($request->extra_bed)? $request->extra_bed: 0,
                'max_guest_allow'=>!empty($request->max_guest_allow)? $request->max_guest_allow: 0,
                'room_size'=>!empty($request->room_size)?$request->room_size: null,
                'rack_price'=>$request->rack_price,
            ]);

            if (!empty($roomU)){
                if(!empty($request->beds) && count($request->beds) > 0){
                    $beds = [];
                    foreach ($request->beds as $bed){
                        $room->beds()->updateOrCreate([
                            'id'=>$bed['id']
                        ],[
                            'bed_type'=>$bed['bed_type'],
                            'bed_size'=>$bed['bed_size'],
                        ]);
                    }
                }

                if(!empty($request->deleted_beds) && count($request->deleted_beds) > 0){
                    $room->beds()->whereIn('id', $request->deleted_beds)->delete();
                }

                DB::commit();
                return redirect()->route('hotel.rooms.index')->with('success', 'Room updated successfully');
            }

            throw new \Exception('Invalid room information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->first();
            if (empty($hotel)) {
                throw new \Exception('Invalid Hotel information');
            }

            $room = $hotel->rooms()->where('id', $id)->first();
            if (empty($room)) {
                throw new \Exception('Invalid Room information');
            }

            if($room->delete()){
                DB::commit();
                return redirect()->route('hotel.rooms.index')->with('success', 'Room deleted successfully');
            }
            throw new \Exception('Invalid room information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function store_room_amenity(Request $request, $id)
    {
        Validator::make($request->all(), [
            'amenity_ids' => ['required','array', 'min:1']
        ])->validate();

        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->first();
            if (empty($hotel)) {
                throw new \Exception('Invalid Hotel information');
            }

            $room = $hotel->rooms()->where('id', $id)->first();
            if (empty($room)) {
                throw new \Exception('Invalid Room information');
            }

            $amenity = $room->facilities()->sync($request->amenity_ids);
            if(!empty($amenity)){
                DB::commit();
                return redirect()->route('hotel.rooms.index')->with('success', 'Room amenity updated successfully');
            }
            throw new \Exception('Invalid amenity information selected');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
