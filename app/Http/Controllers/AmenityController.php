<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AmenityController extends Controller
{       protected $userId;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!empty(Auth::check())) {
                if ($request->user()->user_type == User::Roles['Admin']) {
                    if (empty(session()->get('user_id'))){
                        return $next($request);
                    }
                    $this->userId = session()->get('user_id');
                } else {
                    $this->userId = $request->user()->id;
                }
            }

            return redirect()->route('login');;
        });
    }
    public function index()
    {
        return Inertia::render('Dashboard/Amenity', [
            'amemites' => Amenity::with('parent')->get(),
        ]);
    }
    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amenity_name' => 'required'
        ]);
        try {
            DB::beginTransaction();

            $save_data = Amenity::create([
                'name' => $request->amenity_name,
                'type' => $request->type,
                'parent_id' => !empty($request->parent_id)? $request->parent_id: null,
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
        $amenity = Amenity::find($request->id);
        if (empty($amenity)) {
            throw new \Exception('Failed!');
        }
        $this->validate($request, [
            'amenity_name' =>  'required',
        ]);
        try {

            $update_data = $amenity->update([
                'name' => $request->amenity_name,
                'type' => $request->type,
                'parent_id' => !empty($request->parent_id)? $request->parent_id: null,
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
            $amenity = Amenity::find($request->id);
            if (empty($amenity)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $amenity->delete();
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
    public function  get_property_related_amenity($type){
        $parent_amemites = Amenity::where('type', $type)->where('parent_id',null)->get();
        return  response()->json(['parent_amemites' => $parent_amemites ]);

    }
}
