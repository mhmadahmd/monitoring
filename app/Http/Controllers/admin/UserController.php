<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Image;
use DB;

class UserController extends Controller
{

    public function getCheck()
    {
        return view('admin.Application.chart');
    }
    public function index()
    {
   
        $allUser= User::paginate(10);
        return view('admin.user.allUser',compact('allUser'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.createUser',compact('roles'));
    }

    public function changeStatus($id, $status)
    {
      
        $Status = User::where('id', $id)->update(['account_status'=>$status]);
        return [
            'status' => 0,
            'message' => __('Successfully updated activite user'),
            'reload' => true
        ];
    
    }
    public function saveUser(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password'=> 'required',
                'gender'=> 'required',
                'address'=> 'required',
                'role'=> 'required',
                 ]
                 
        ); 
      
     
      $userData = $request->all();
      $userData['password'] = Hash::make($userData['password']);

      if ($request->hasfile('image')) {
        $Imag = $request->file('image');
        $ext = $Imag->GetClientOriginalExtension();
        $filename = 'profile' . '_' . time() . '.' . $ext;
        $location = public_path("/img/" . $filename);
        Image::make($Imag->getRealPath())->resize(800, 400)->save($location);
   
            $userData['img'] = $filename;
        }

        $user = User::create($userData );
        $user->assignRole($request->input('role'));


        return [
            'status' => 0,
            'message' => __('Successfully created new user'),
            'redirect' =>route('users.index'),
        ];

    }

    public function activeLog()
    {
        $activities = Activity::all();
        $arr = [];
        foreach($activities as $activity) {
      
          if ($activity->description == 'updated') {
          
            $properties = $activity->properties->toArray();
            $subArr['attributes'] []= $properties['attributes'];
            $subAtrr= $properties['attributes'];
            $subArr['old'] []= $properties['old'];
            }
          }
          foreach ($subArr['attributes'] as $key => $value) {

            $fullDiff =array_merge(array_diff($subArr['attributes'][ $key], $subArr['old'][ $key]), array_diff($subArr['old'][ $key], $subArr['attributes'][ $key]));
            array_push($arr, $fullDiff);
          }
        
         return view('admin.user.activity',compact('activities','arr'));
    }



    public function edit($id)
    {
     
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.user.createUser',compact('user','roles','userRole'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasfile('image')) {
            $Imag = $request->file('image');
            $ext = $Imag->GetClientOriginalExtension();
            $filename = 'profile' . '_' . time() . '.' . $ext;
            $location = public_path("/img/" . $filename);
            Image::make($Imag->getRealPath())->resize(500, 500)->save($location);
            $request->merge(['img' => $filename]);
        }
        
    $input = $request->all();
    if(!empty($input['password'])){ 
        $input['password'] = Hash::make($input['password']);
    }else{
        $input = Arr::except($input,array('password'));    
    }
    

    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();

    $user->assignRole($request->input('role'));
  
    return [
        'status' => 0,
        'message' => __('User updated successfully'),
        'redirect' =>route('users.index'),
     
    ];
    // return redirect()->route('users.index')
    //                 ->with('success','User updated successfully');


    }



    public function destroy($id)
    {
        User::find($id)->delete();

        return [
            'status' => 1,
            'message' => __('User deleted successfully'),
            'reload' => true,
        ];
        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');
    }


}
