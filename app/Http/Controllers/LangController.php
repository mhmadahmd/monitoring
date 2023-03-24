<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;

class LangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change( $lang)
    {
        if (array_key_exists($lang, config('app.available_locales'))) {
            Session::put('applocale', $lang);
        }
        return redirect()->back();

    }
}
