<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id=-1;
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
        }
        if($id==4)
        return redirect()->action('UsersController@index')->with(['user' => $id]);
        else
            return View('fake');
    }

}
