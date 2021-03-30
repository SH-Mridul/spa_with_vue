<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id','name','slug')->latest()->get();
        $data = [
            'categories' => $categories
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames = array(
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
        );

        $validator = Validator::make($attributeNames, [
            'name'         => 'required',
            'slug'         => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }else if(Category::where('name',$request->name)->exists()){
            return response()->json("already exist!", 200);
        } else {
            Category::create($attributeNames);
            return response()->json("added new category!", 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if ($category) {
          return response()->json($category,200);
      }else{
           return response()->json('faild!',404);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $attributeNames = array(
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
        );

        $validator = Validator::make($attributeNames, [
            'name'         => 'required|unique:categories,name,'.$category->id,
            'slug'         => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }else {
            $category->update($attributeNames);
            return response()->json("updated category!", 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category) {
            // $category->delete();
            return response()->json('success',200);
        }else{
             return response()->json('faild',404);
        }
    }
}
