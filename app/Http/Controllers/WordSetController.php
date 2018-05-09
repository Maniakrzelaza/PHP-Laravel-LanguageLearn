<?php

namespace App\Http\Controllers;

use App\Priviliges;
use App\Users;
use Illuminate\Http\Request;
use App\WordSet;
use App\Lang;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class WordSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function wordsetEdit($id)
    {
        $wordset = WordSet::find($id);
        $langList = Lang::all();
        $subcategoryList= Subcategory::all();
        return View('words.wordsetEdit')->with(['wordset'=> $wordset , 'langList'=> $langList, 'subcategoryList' => $subcategoryList]);
    }
    public function showPrivateSet()
    {
        $wordsets =WordSet::all()->where('user_id',Auth::user()->id)->where('priv',1);
        return View('words.showPrivateSet')->with(['wordsets'=> $wordsets ]);
    }

    public function storePrivateSet(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body' => 'required'
        ]);
        $wordset = new WordSet;
        $wordset->name= $request->input('title');
        $wordset->words= $request->input('body');
        $wordset->lang1_id = $request->input('lang1');
        $wordset->lang2_id =$request->input('lang2');
        $wordset->subcategory_id=$request->input('subcategory');
        $wordset->user_id=Auth::user()->id;
        $wordset->quant=1;
        $wordset->priv=1;
        $wordset->save();
        return redirect('category')->with('success','Zestaw utworzony');
    }
    public function createPrivateSet()
    {
        $wordset =WordSet::all();
        $langList = Lang::all();
        $subcategoryList= Subcategory::all();
        return View('words.createPrivateSet')->with(['wordset'=> $wordset , 'langList'=> $langList, 'subcategoryList' => $subcategoryList]);
    }

    public function index()
    {
        $subcategoryId=Priviliges::select('subcategory_id as id')->where('user_id',Auth::user()->id)->get();
        $arr=array();
        foreach ($subcategoryId as $sub)
        {
            array_push($arr,$sub->id);
        }

        $wordset =WordSet::all()->where('priv',0);
        $langList = Lang::all();
        if(Users::all()->find(Auth::user()->id)->role_id==4)
        {
            $subcategoryList= Subcategory::all();
        }
        else
        {
            $subcategoryList= Subcategory::all()->find($arr);
        }
        return View('words.index')->with(['wordset'=> $wordset , 'langList'=> $langList, 'subcategoryList' => $subcategoryList]);
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
        $this->validate($request,[
            'title'=> 'required',
            'body' => 'required'
        ]);
        $wordset = new WordSet;
        $wordset->name= $request->input('title');
        $wordset->words= $request->input('body');
        $wordset->lang1_id = $request->input('lang1');
        $wordset->lang2_id =$request->input('lang2');
        $wordset->subcategory_id=$request->input('subcategory');
        $wordset->user_id=Auth::user()->id;
        $wordset->quant=1;
        $wordset->save();
        return redirect('category')->with('success','Zestaw utworzony');
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
        $this->validate($request,[
            'title'=> 'required',
            'body' => 'required'
        ]);
        $wordset = WordSet::find($id);
        $wordset->name= $request->input('title');
        $wordset->words= $request->input('body');
        $wordset->lang1_id = $request->input('lang1');
        $wordset->lang2_id =$request->input('lang2');
        $wordset->subcategory_id=$request->input('subcategory');
        $wordset->priv=unserialize($request->priv);
        $wordset->user_id=Auth::user()->id;
        $wordset->quant=1;
        $wordset->save();
        return redirect('category')->with('success','Zestaw zedytowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wordset = WordSet::find($id);
        $wordset->delete();
        $wordsets =WordSet::all()->where('user_id',Auth::user()->id)->where('priv',1);
        return View('words.showPrivateSet')->with(['wordsets'=> $wordsets ]);;
    }
}
