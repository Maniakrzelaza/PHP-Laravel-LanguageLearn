<?php

namespace App\Http\Controllers;

use App\Results;
use App\Subcategory;
use App\WordSet;
use Illuminate\Http\Request;
use App\Category;
use App\Users;
use App\Priviliges;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =Category::all();
        $id=-1;
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
            $user=Users::all()->find(Auth::user()->id);
            return View('category.index')->with(['categories' => $categories,'user' => $id,'realUser'=>$user]);
        }
        $fakeUser=new Users;
        return View('category.index')->with(['categories' => $categories,'user' => $id,'realUser'=>$fakeUser]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCategories()
    {
        $categories = Category::all();
        return View('category.showCategories')->with(['categories'=>$categories]);
    }
    public function create()
    {
        $categories=Category::all();
        return View('category.addCategory')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category= new Category;
        $category->name=$request->title;
        $category->description=$request->body;
        $category->save();
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
        $cat=Category::find($id);
        return View('category.editCategory')->with(['cat'=>$cat,'id'=>$id]);
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
        $cat=Category::find($id);
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
        $category=Category::find($id);
        $subcategories=Subcategory::select('id as id')->where('category_id',$id)->get();
        $subId= array();
        foreach ($subcategories as $sub)
        {
            array_push($subId,$sub->id);
        }
        $privs=Priviliges::where('subcategory_id',$subId)->delete();
        $wordsets=WordSet::select('id as id')->where('subcategory_id',$subId)->get();
        $wsetId= array();
        foreach ($wordsets as $set)
        {
            array_push($wsetId,$set->id);
        }
        if(count($wsetId)!=0)
        {
            $results=Results::where('word_set_id',$wsetId)->delete();
            $wordsets=WordSet::where('id',$wsetId)->delete();
        }


        $subcategories=Subcategory::where('category_id',$id)->delete();
        $category->delete();
        return $this->showCategories();

    }
}
