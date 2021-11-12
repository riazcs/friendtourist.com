<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use \Illuminate\Support\Str;
class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::where('status',1)->orderBy('id','DESC')->get();
        if($blogs){
            foreach($blogs as $blog){
                $blog->description = Str::limit(strip_tags($blog->description),150);
          }
        }
        return Inertia::render('Blog/Blog',compact('blogs'));
    }


    public function create()
    {
        return Inertia::render('Blog/CreateBlog',[
            'blog_types' => Settings::where('name', 'blog_type')->get()
        ]);
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'image' => ['required'],
            'image.*'=>['image', 'mimes:jpeg,jpg,png','max:1024'],
        ])->validate();
        try {
            DB::beginTransaction();
            $save_data = Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'status' => $request->status,
            ]);
            if (!empty($save_data)) {
                $blog = Blog::find($save_data->id);
                if (empty($blog)){
                    throw new \Exception('Invalid blog information');
                }
                $blog->uploadAttachmentWithoutPrevDelete($request->image);
                DB::commit();
                return redirect()->route('admin.blog.index');
            } else {
                throw new \Exception('Failed!');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    public function show($id)
    {
       $blog = Blog::with('attachment')->find($id);
       return Inertia::render('Blog/BlogDetails',compact('blog'));
    }


    public function show_details($id)
      {
       $blog = Blog::with('attachment')->find($id);
       return Inertia::render('Blog/ShowBlogDetails',compact('blog'));
     }


    public function edit(Blog $blog)
    {
        $blog = Blog::with('attachment')->find($blog->id);
        $blog_types = Settings::where('name', 'blog_type')->get();
//
//        $logo = file_get_contents($blog->attachment->file_path);
//        $encoded = base64_encode($logo);
//        $image = 'data:image/jpeg;base64,' . $encoded;
//        dd($image);


        return Inertia::render('Blog/EditBlog',compact('blog','blog_types'));
    }


    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            throw new \Exception('Failed!');
        }
        $this->validate($request, [
            'description' =>  'required',
        ]);
        try {
            $update_data = $blog->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            if (!empty($update_data)) {
                if($request->image){
                    $blog->uploadAttachmentWithoutPrevDelete($request->image);
                }
                DB::commit();
                return redirect()->route('admin.blog.index');
            } else {
                throw new \Exception('Failed!');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage())->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $amenity = Blog::find($id);
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

    public function blog_type()
    {
      return Inertia::render('Blog/BlogType',[
          'blog_types' => Settings::where('name', 'blog_type')->get()
      ]);
    }

    public function add_blog_type(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required'
        ])->validate();
        try {
            DB::beginTransaction();

            $save_data = Settings::create([
                'data' => $request->name,
                'name' => 'blog_type',
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

    public function upload_blog_photos(Request $request)
    {
        $result = [];
        $name = $request->file('upload')->getClientOriginalName();
        $path = $request->file('upload')->store('images/blog');
        if(!empty($path)){
            $result['result'] = 'success';
            $result['message'] = 'Image Upload Successfully.';
            $result['path'] = URL::to('/').'/storage/'.$path;
        } else{
            $result['result'] = 'error';
            $result['message'] = 'Image Upload Failed.';
        }
        return response()->json($result);
    }
}
