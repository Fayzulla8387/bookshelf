<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $parents=Category::where('parent_id',null)->get();
//        dd($categoires)
        return  view('backend.pages.category.index',compact('categories','parents'));
;    }

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
        $request->validate([
            'name'=>'required',
            'slug'=>'nullable|unique:categories',
            'description'=>'required'
        ]);
//        dd($request);
        $categories=new Category();
        $categories->name=$request->name;
       if(empty($request->slug)){
           $categories->slug=str_slug($request->name);
       }else {
           $categories->slug=($request->name);
       }
       $categories->parent_id=$request->parent_id;
       $categories->description=$request->description;
       $categories->save();
       session()->flash('success','Categoriya muvaffqatli yaratildi');
return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $categories=Category::find($id);
        $request->validate([
            'name'=>'required',
            'slug'=>'nullable|unique:categories,slug,'.$categories->id,
            'description'=>'required'
        ]);

        $categories->name=$request->name;
        if(empty($request->slug)){
            $categories->slug=str_slug($request->name);
        }else {
            $categories->slug=($request->name);
        }
        $categories->parent_id=$request->parent_id;
        $categories->description=$request->description;
        $categories->save();
        session()->flash('success','Categoriya muvaffqatli tahrirlandi');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $child_categories=Category::where('parent_id',$id)->get();
        foreach ($child_categories as $child_category) {
            $child_category->delete();
      }
        $category=Category::find($id);
        $category->delete();
        session()->flash('success','Categoriya muvaffqatli ochirildi');
        return redirect(route('admin.categories.index'));
    }
}
