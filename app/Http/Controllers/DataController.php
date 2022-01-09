<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function skor()
    {
        return view('pages.datalist.skor');
    }
    public function moment()
    {
        return view('pages.datalist.moment');
    }

    public function ujit()
    {
        return view('pages.datalist.ujit');
    }

    public function anava()
    {
        return view('pages.datalist.anava');
    }
}
