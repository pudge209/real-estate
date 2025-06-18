<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LangController extends Controller
{
    function setLang(Request $request){
        $lang = $request->lang;
        App::setlocale($lang);
        // return trans('custom.test');
        // return __('custom.test');
        $cookie=Cookie::make('lang',$lang,60*24*364);
        return back()->withCookie($cookie);
    }
}
