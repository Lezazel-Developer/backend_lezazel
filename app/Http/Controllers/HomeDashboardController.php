<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{
    public function index(){
        return view('pages.home.index', ["type_menu" => "dashboard"]);
    }
}
