<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function allUser()
    {
        $allUser= User::paginate(10);
        return view('admin.allUser',compact('allUser'));
    }

    public function create()
    {
        return view('admin.createUser');
    }
    public function saveUser(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password'=> 'required',
                // 'birthday'=> 'required',
                'gender'=> 'required',
                // 'img'=> 'required|image|mimes:jpg,jpeg,png',
                // 'phone_number'=> 'required|digits:10',
                'address'=> 'required',
                'role'=> 'required',
                 ]
                 
        ); 
      
     
      $userData = $request->all();
      $userData['password'] = Hash::make($userData['password']);

      if ($request->hasfile('img')) {
        $Imag = $request->file('img');
        $ext = $Imag->GetClientOriginalExtension();
        $filename = 'product' . '_' . time() . '.' . $ext;
        $location = public_path("/img/" . $filename);
        Image::make($Imag->getRealPath())->resize(800, 400)->save($location);
   
        $userData['img'] = $filename;
    }

    $u = User::create($userData );

  

    return [
      'status' => 0,
      'message' => __('Successfully created new user'),
      'reload' => true
        ];
    }
}
