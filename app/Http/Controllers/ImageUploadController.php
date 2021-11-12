<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use App\Traits\HasAttachmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ImageUploadController extends Controller
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

    public function index()
    {
        return Inertia::render('UploadPhotos/AllImages');
    }
    public function create($type)
    {
        $rooms = '';
        $hotel = Hotel::where('user_id', $this->userId)->with('attachments', 'rooms')->first();
        if($type == 'room'){

            $rooms = $hotel->rooms()->with('attachments')->latest()->get();
        }
        return Inertia::render('UploadPhotos/UploadImage', compact('type', 'hotel', 'rooms'));
    }

    public function upload(Request $request)
    {

        Validator::make($request->all(), [
            'images' => ['required', 'array', 'min:1'],
            'images.*'=>['image', 'mimes:jpeg,jpg,png','max:1024'],
        ])->validate();

        try {
            DB::beginTransaction();

            if (empty($request->type)){
                throw new \Exception('Invalid information');
            }

            if($request->type == 'hotel'){
                $hotel = Hotel::where('user_id', $this->userId)->first();
                if (empty($hotel)){
                    throw new \Exception('Invalid hotel information');
                }

                foreach ($request->images as $image){
                    $hotel->uploadAttachmentWithoutPrevDelete($image);
                }
            }

            DB::commit();
            return  back()->with('success', 'Images uploaded successfully');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $photo = Attachment::find($id);
            if (empty($photo)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $photo->delete();
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
    public function room_photos()
    {
        $rooms = '';
        $hotel = Hotel::where('user_id', $this->userId)->with('rooms')->latest()->first();
        $rooms = $hotel->rooms()->with('attachments')->latest()->get();
        return Inertia::render('UploadPhotos/RoomUploadPhoto', compact('hotel', 'rooms'));
    }

    public function get_room_photos($hotelId,$roomId)
    {
        $rooms = '';
        if($roomId){
            session()->put('roomId',$roomId);
            $hotel = Hotel::where('user_id', $this->userId)->with('rooms')->latest()->find($hotelId);
            $rooms = Room::where('hotel_id', $hotelId)->with('attachments')->find($roomId);
            return Inertia::render('UploadPhotos/RoomUploadPhoto', compact('hotel', 'rooms'));
        }else{
            return  back()->with('error', 'No room. Please create room first.');
        }
    }
    public function upload_room_photos(Request $request)
    {
        Validator::make($request->all(), [
            'images' => ['required', 'array', 'min:1'],
            'images.*'=>['image', 'mimes:jpeg,jpg,png','max:1024'],
            'room_id' => ['required']
        ],
        [
            'room_id.required' => "Please Select A Room First!"
        ])->validate();
        //TODO room empty validation


        try {
            DB::beginTransaction();
                $room = Room::find($request->room_id);
                if (empty($room)){
                    throw new \Exception('Invalid room information! Select Room First');
                }

                foreach ($request->images as $image){
                    $room->uploadAttachmentWithoutPrevDelete($image);
                }

            DB::commit();
            return  back()->with('success', 'Images uploaded successfully');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
