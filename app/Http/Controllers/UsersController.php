<?php

namespace App\Http\Controllers;

use App\Results;
use App\Subcategory;
use App\WordSet;
use Illuminate\Http\Request;
use App\Users;
use App\Role;
use App\Priviliges;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account()
    {
        $userId=Auth::user()->id;
        $wordSetIdsa=Results::select('word_set_id')->where('user_id', Auth::user()->id)->get();
        $uniq = WordSet::find($wordSetIdsa);
        $count=array();
        $sumArray= array();
        foreach ($uniq as $key=>$u){
            $sum = Results::all()->where('user_id',$userId)->where('word_set_id',$u->id)->sum('result');
            $count[$key]=Results::all()->where('user_id',$userId)->where('word_set_id',$u->id)->count();
            $sumArray[$key]=$sum/$count[$key];
        }
        return View('account')->with(['results'=>$uniq,'sums'=>$sumArray ,'count'=>$count]);
    }

    public function index()
    {
        $id=-1;
        $users =Users::all();
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
        }
        if($id==4)
            return View('admin')->with('users', $users);
        else
            return View('fake');

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
        //
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
        $uid=-1;
        $user =Users::find($id);
        $subcategories=Subcategory::all();
        $userPriviliges=Priviliges::all()->where('user_id',$id);
        if(Auth::check())
        {
            $uid= Auth::user()->role_id;
            $roles=Role::all();
        }
        if($uid==4)
            return View('editUser')->with(['editUser'=> $user,'roles'=>$roles,'subcategorie'=>$subcategories,'userPriviliges'=>$userPriviliges]);
        else
            return View('fake');
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
        $role=$request->role;
        $name=$request->title;
        $user = Users::find($id);
        $user->name=$name;
        $user->role_id=$role;
        $user->save();

        $id=-1;
        $users =Users::all();
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
        }
        if($id==4)
            return View('admin')->with('users', $users);
        else
            return View('fake');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= Users::find($id);
        $user->delete();
        $users =Users::all();
        return View('admin')->with('users', $users);
    }
}
