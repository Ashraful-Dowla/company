<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'))->with('success', 'User logout Succefully');
    }

    public function cPassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $validate_data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->current_password, $hashedPassword))
        {
            User::find(Auth::id())->update([
                'password' => Hash::make($request->password)
            ]);

            Auth::logout();
            return redirect(route('login'))->with('success', 'Password is successfully changed');
        }else{
            return redirect()->back()->with('error', 'Current password is invalid');
        }
    }

    public function profileUpdate()
    {
        if(Auth::user()){
            $user = User::find(Auth::id());
            return view('admin.update-profile', compact('user'));
        }
    }

    public function update(Request $request)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_photo_path' => 'image|mimes:jpg,jpeg,png'
        ]);

        if(Auth::user()){

            $profile_image = $request->file('profile_photo_path');

            if($profile_image){

                $name_gen = hexdec(uniqid()).'.'.$profile_image->getClientOriginalExtension();
                $last_img = 'profile-photos/'.$name_gen;

                Storage::delete($request->old_image);

                Image::make($profile_image)->resize(200, 200)->save('storage/'.$last_img);

                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'emai' => $request->email,
                    'profile_photo_path' => $last_img
                ]);
            }else {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'emai' => $request->email
                ]);
            }
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
    }
}
