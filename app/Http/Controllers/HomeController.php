<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }

    public function beranda(){
        return view('home.beranda');
    }
    public function informasi(){
        return view('home.informasilayanan');
    }

    public function lokasi(){
        return view('home.lokasi');
    }
}
