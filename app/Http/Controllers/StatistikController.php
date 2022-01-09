<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function frequensi()
    {
        return view('pages.statistika.frequensi');
    }

    public function bergolong()
    {
        return view('pages.statistika.bergolong');
    }

    public function chi()
    {
        return view('pages.statistika.chi');
    }

    public function lilliefors()
    {
        return view('pages.statistika.lilliefors');
    }

    public function moment()
    {
        return view('pages.statistika.moment');
    }

    public function ujit()
    {
        return view('pages.statistika.ujit');
    }

    public function anava()
    {
        return view('pages.statistika.anava');
    }
}
