<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request):RedirectResponse
    {
        if($request->session()->get("user")){
            return redirect('/todolist');
        }else{
            return redirect('/login');
        }
    }
}
