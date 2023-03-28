<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Category;
use App\Models\User;
use Image;
use DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allApplication= Application::paginate(10);
        return view('admin.Application.index',compact('allApplication'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Category = Category::all();
        $users = User::all();
        return view('admin.Application.create',compact('Category','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate(
            [
                'name'=> 'required',
                'domain' => 'required|unique:applications,domain',
                'ip' => 'required',
                'category' => 'required',
                 ]
        ); 
      
        if ($request->hasfile('image')) {
            $Imag = $request->file('image');
            $ext = $Imag->GetClientOriginalExtension();
            $filename = 'GYM' . '_' . time() . '.' . $ext;

            $location = public_path("/img/" . $filename);

            Image::make($Imag->getRealPath())->resize(800, 400)->save($location);
            $request->merge(['img' => $filename]);
        }
        $application = Application::create($request->all() );
        if ($application->save()) {
            $application->users()->sync($request->user);
        }
  
        return [
            'status' => 0,
            'message' => __('Successfully created new applications'),
            'redirect' =>route('app.index'),
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $application = Application::find($id);
        $Category = Category::all();
        $users = User::pluck('name','id')->all();
        $userApp = $application->users->pluck('name','id')->all();
        return view('admin.Application.create',compact('application','Category','users','userApp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         Application::where('id',$id)
        ->update($request->except('_token','user'));
        $app = Application::find($id);
        DB::table('application_user')->where('application_id',$id)->delete();
        $app->users()->sync($request->user);
        return [
            'status' => 0,
            'message' => __('application updated successfully'),
            'redirect' =>route('app.index'),
         
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Application::find($id)->delete();
        return [
            'status' => 1,
            'message' => __('application deleted successfully'),
            'reload' => true,
         
        ];
    }
}
