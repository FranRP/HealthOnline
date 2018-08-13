<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{
	public function __construct() 
	{
		$this->middleware('example', ['only' =>['home']]);
	}

    public function home() {
    	return view('home');
    }



}
