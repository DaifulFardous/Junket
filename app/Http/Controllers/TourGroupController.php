<?php

namespace App\Http\Controllers;

use App\Models\TourGroup;
use App\Models\Feed;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TourGroupController extends Controller
{
    public function index(){
        return view('group.login');
    }
    public function register(){
        return view('group.register');
    }
    public function registerCreate(Request $request){
        $group = new TourGroup();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/groups',$fileName);
            $group->image = $fileName;
        }
        $group->group_name = $request->group_name;
        $group->owner_name = $request->owner_name;
        $group->email = $request->email;
        $group->phone = $request->phone;
        $group->password = Hash::make($request->password);
        $group->location = $request->location;
        $group->about_us = $request->about_us;
        $group->save();
        return redirect('group/login')->with('message','Account created successfylly!');
    }
    public function login(Request $request){
        $check = $request->all();
        if(Auth::guard('group')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect('group/dashboard')->with('message','Login successfully');
        }else{
            return redirect()->back()->with('message', 'Invaild email or password');
        }
    }
    public function dashboard(){
        return view('group.index');
    }
    public function logout(){
        Auth::guard('group')->logout();
        return redirect('group/login')->with('message','Logout successfully');
    }
    public function feedDetails($group_name){
        $feeds = Feed::where('group_name','=',$group_name)->get();
        return view('group.feedList' , compact('feeds'));
    }
    public function feedEdit($id){
        $feed = Feed::findOrFail($id);
        return view('group.feedEdit', compact('feed'));
    }
    public function feedUpdate(Request $request,$id){
    
        $feed = Feed::findOrFail($id);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/feeds',$fileName);
            $feed->image = $fileName;
        }
        $feed->heading = $request->heading;
        $feed->short_description = $request->short_description;
        $feed->long_description = $request->long_description;
        $feed->status = 'pending';
        $feed->update();
        return redirect('group/feed/list/'.$feed->group_name);
    }
    public function feedDelete($id){
        $feed = Feed::find($id);
        $feed->delete();
        return redirect('group/feed/list/'.$feed->group_name);
    }
    public function blogDetails($group_name){
        $blogs = Blog::where('group_name','=',$group_name)->get();
        return view('group.blogList' , compact('blogs'));
    }
    public function blogEdit($id){
        $blog = Blog::findOrFail($id);
        return view('group.blogEdit', compact('blog'));
    }
    public function blogUpdate(Request $request,$id){
    
        $blog = Blog::findOrFail($id);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/blogs',$fileName);
            $blog->image = $fileName;
        }
        $blog->heading = $request->heading;
        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;
        $blog->status = 'pending';
        $blog->update();
        return redirect('group/blog/list/'.$blog->group_name);
    }
    public function blogDelete($id){
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('group/blog/list/'.$blog->group_name);
    }
}