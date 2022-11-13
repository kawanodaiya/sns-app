<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetController extends Controller
{
    public static function settings(){

        return view('set.show');

    }
}
