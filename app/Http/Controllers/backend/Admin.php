<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function index()
    {
        return view('Pages.login');
    }  
      
    public function customLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
    
    
        $remember_me = $request->has('remember') ? true : false; 
      // dd($remember_me);

    
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me))
        {
            $user = auth()->user();
//            dd($user);
            $request->session()->put('id',$user->id);
            $request->session()->put('name',$user->name);
            $request->session()->put('email',$user->email);
            $request->session()->put('user_id',$user->id);
            $request->session()->put('role',$user->role);
            $request->session()->put('use_image',$user->use_image);
            $request->session()->put('phone',$user->phone);
               $request->session()->put('image',$user->image);

          return redirect()->to('/dashboard') ->withSuccess('Signed in');
          
        }else{
            return redirect()->back()->with('msg', 'Please enter valid login credentials.');  
        }
    
    }
    public function customLogin2(Request $request)// comment 26-11-2021 without remember me use
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        // print_r($credentials);
        // exit;
        if (Auth::attempt($credentials)) {
            $user = User::where("email",$request->email)->first();
          //  dd( $user->name);
             $request->session()->put('id',$user->id);
            $request->session()->put('name',$user->name);
            $request->session()->put('email',$user->email);
            $request->session()->put('user_id',$user->id);
            $request->session()->put('role',$user->role);
            $request->session()->put('use_image',$user->use_image);
            $request->session()->put('phone',$user->phone);
               $request->session()->put('image',$user->image);

          return redirect()->to('/dashboard') ->withSuccess('Signed in');
          
          //  return redirect()->intended('dashboard')
            //            ->withSuccess('Signed in');
        }
    return redirect()->back()->with('msg', 'Please enter valid login credentials.');  
     
    }


    public function dashboard()
    {
        if(Auth::check()){
            return view('Pages.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        request()->session()->regenerateToken();

        Auth::logout();
        return Redirect('login'); //redirect back to login
    }
    
    
}
