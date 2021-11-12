<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FaqController extends Controller
{
    public function index()
    {
        $login_user = auth()->user();
        if($login_user && $login_user->user_type == 1){
            return Inertia::render('FAQ/FAQ',[
                'faqs' => Faq::where('faqable_id',$login_user->id)->get(),
            ]);
        }else{
            return Inertia::render('FAQ/HotelFAQ',[
                'faqs' => Faq::where('faqable_id',$login_user->id)->get(),
            ]);
        }
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $save_data = new Faq();
            $save_data->question = $request->question;
            $save_data->answer = $request->answer;
            $save_data->status = $request->status;
            if (!empty($save_data)) {
                if( auth()->user()->user_type === User::Roles['Admin'])
                    auth()->user()->faqs()->save($save_data);
                elseif ( auth()->user()->user_type === User::Roles['Hotel Admin'])
                    auth()->user()->hotel->faqs()->save($save_data);
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


    public function show(Faq $faq)
    {

    }


    public function edit(Faq $faq)
    {

    }


    public function update(Request $request ,$id)
    {
        $faq = Faq::find($id);
        if (empty($faq)) {
            throw new \Exception('Failed!');
        }
        $this->validate($request, [
            'question' =>  'required',
        ]);
        try {
            $update_data = $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'status' => $request->status,
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


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $faq = Faq::find($id);
            if (empty($faq)) {
                throw new \Exception('Failed!');
            }
            $delete_data = $faq->delete();
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
