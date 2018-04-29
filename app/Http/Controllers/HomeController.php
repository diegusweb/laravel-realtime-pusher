<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class HomeController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index () {
	    if(auth()->check()){
	        if(!session()->has('cart')){
	            session()->put('cart', new Collection());
	            session()->save();
            }
        }
        return view('home');
    }
}
