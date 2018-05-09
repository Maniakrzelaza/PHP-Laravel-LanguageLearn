<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Category;
use App\Users;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    public function showCategories()
    {
        $categories = Category::all();
        return View('category.showCategories')->with(['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $subcategory= new Subcategory;
        $subcategory->name=$request->title;
        $subcategory->description=$request->body;
        $subcategory->category_id=$request->subcategory;
        $subcategory->save();
        return $this->showCategories();
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
        $cat=Subcategory::find($id);
        return View('category.editSubcategory')->with(['cat'=>$cat,'id'=>$id]);
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
        $cat=Subcategory::find($id);
        $cat->name=$request->title;
        $cat->description=$request->body;
        $cat->save();
        return $this->showCategories();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory=Subcategory::find($id);
        $subcategory->delete();
        $categories = Category::all();
        return View('CategoryController@showCategories')->with(['categories'=>$categories]);
    }
}
