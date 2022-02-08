<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage(Request $request, $locale){
    	
		$request->session()->put('lang',$locale);
		return back();

    }
}
