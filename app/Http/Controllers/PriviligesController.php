<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Priviliges;
use App\Users;
use App\Role;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;

class PriviligesController extends Controller
{
    public function addPrivilige(Request $request,$id)
    {
        $isPrivExists=Priviliges::all()->where('user_id',$id)->where('subcategory_id',$request->subcategory);
        if(count($isPrivExists)==0)
        {
            $priv= new Priviliges;
            $priv->user_id=$id;
            $priv->subcategory_id=$request->subcategory;
            $priv->save();
        }
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
    public function removePrivilige(Request $request,$id)
    {
        $privs=Priviliges::where('user_id',$id)->where('subcategory_id',$request->privilige)->delete();
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
}
