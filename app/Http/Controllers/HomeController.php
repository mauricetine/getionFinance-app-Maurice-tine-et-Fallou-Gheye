<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if ($usertype=='user') {
                return view('dashboard');
            }elseif($usertype=='admin'){
               return view('admin.adminhome'); 
            
            }elseif($usertype=='guichet'){
               return view('guichet.guichethome'); 
            }
            else
            {
                return redirect()->back();
            }
            

        }
    }

    public function post()
    {
        return view( "post");
    }
    public function guichetpage()
    {
        return view( "guichet/guichetpage");
    }
}
