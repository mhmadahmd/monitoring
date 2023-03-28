<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcategory= Category::paginate(10);
        return view('admin.Category.index',compact('allcategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=> 'required',
                 ]
        ); 
      
    
        $category = Category::create($request->all() );
      
        return [
            'status' => 0,
            'message' => __('Successfully created new category'),
            'redirect' =>route('category.index'),
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
        $category = Category::find($id);
        return view('admin.Category.create',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::where('id',$id)
        ->update($request->only(['name']));
        return [
            'status' => 0,
            'message' => __('category updated successfully'),
            'redirect' =>route('category.index'),
         
        ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return [
            'status' => 1,
            'message' => __('Category deleted successfully'),
            'reload' => true,
         
        ];
    }
}
