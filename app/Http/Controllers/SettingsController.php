<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\FavouriteArea;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Setting/Setting');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'type_name' => 'required'
        ]);
        try {
            DB::beginTransaction();

            $save_data = Settings::create([
                'name' => $request->type_name,
                'data' => $request->facility,
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

    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
        $Settings = Settings::find($request->id);
        if (empty($Settings)) {
            throw new \Exception('Failed!');
        }
        $this->validate($request, [
            'type_name' =>  'required',
        ]);
        try {

            $update_data = $Settings->update([
                'name' => $request->type_name,
                'data' => $request->facility,
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

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $Settings = Settings::find($request->id);
            if (empty($Settings)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $Settings->delete();
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


    public function property_type_setting($type)
    {
        if ($type == 'property_type') {
            $settings = Settings::where('name', 'property_type')->get();
        } elseif ($type == 'room_type') {
            $settings = Settings::where('name', 'room_type')->get();
        } elseif ($type == 'bed_type') {
            $settings = Settings::where('name', 'bed_type')->get();
        } elseif ($type == 'room_view') {
            $settings = Settings::where('name', 'room_view')->get();
        } elseif ($type == 'room_characteristics') {
            $settings = Settings::where('name', 'room_characteristics')->get();
        } else {
            $settings = Settings::where('name', 'bed_size')->get();
        }
        return Inertia::render('Setting/PropertyTypeSetting', [
            'property_types' => $settings, 'type' => $type
        ]);
    }

    public function get_district()
    {
        return Inertia::render('Setting/DistrictSetting', [
            'districts' => District::with('division')->get()
        ]);
    }

    public function get_user_list(){
        return Inertia::render('User/UserList',
            ['users' => User::where('user_type',User::Roles['User'])->get()]);
    }

    public function change_user_status($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if (empty($user)) {
                throw new \Exception('Failed!');
            }
            $update = $user->update([
                'status' => 3   //3 for block
            ]);
            if (!empty($update)) {
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

    public function favourite_area()
   {
    return Inertia::render('Setting/FavouriteArea',
        ['favourite_areas' => FavouriteArea::with('attachments')->get()]);
     }

    public function add_favourite_area(Request $request)
    {
        Validator::make($request->all(), [
            'area_name' => 'required',
            'images' => ['required', 'array', 'min:1'],
            'images.*'=>['image', 'mimes:jpeg,jpg,png','max:1024'],
        ])->validate();
        try {
            DB::beginTransaction();
            $save_data = FavouriteArea::create([
                'area_name' => $request->area_name,
                'status' => 1,
            ]);
            if (!empty($save_data)) {
                $area = FavouriteArea::find($save_data->id);
                if (empty($area)){
                    throw new \Exception('Invalid hotel information');
                }
                foreach ($request->images as $image){
                    $area->uploadAttachmentWithoutPrevDelete($image);
                }
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

    public function delete_area(Request $request)
    {
        try {
            DB::beginTransaction();
            $area = FavouriteArea::find($request->id);
            if (empty($area)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $area->delete();
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

    public function terms_policy(){
        $settings = Settings::where('name', 'refund_policy')
            ->orWhere('name', 'emi_policy')
            ->orWhere('name', 'privacy_policy')
            ->orWhere('name', 'terms')
            ->get();
        return Inertia::render('Setting/TermsPolicy',compact('settings'));
    }

    public function get_terms_policy($type){
        $result = '';
        $term_policy = Settings::where('name', $type)->first();
        if(!empty($term_policy)){
            $result = $term_policy;
        }
        return  response()->json(['result'=>$result]);
    }

    public function store_terms_policy(Request $request){
        $this->validate($request, [
            'description' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $save_data = Settings::updateOrCreate([
                'id' => $request->setting_id
            ], [
                'name' => $request->type,
                'data' => $request->description,
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

    public function social_link(){
        $settings = Settings::where('name', 'facebook')
            ->orWhere('name', 'linkedin')
            ->orWhere('name', 'youtube')
            ->orWhere('name', 'instagram')
            ->orWhere('name', 'twitter')
            ->get();
        return Inertia::render('Setting/SocialLink',compact('settings'));
    }

    public function store_social_link(Request $request){
        $this->validate($request, [
            'type' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $save_data = Settings::updateOrCreate([
                'id' => $request->setting_id
            ], [
                'name' => $request->type,
                'data' => $request->social_link,
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

    public function delete_social_link(Request $request)
    {
        try {
            DB::beginTransaction();
            $area = Settings::find($request->setting_id);
            if (empty($area)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $area->delete();
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
