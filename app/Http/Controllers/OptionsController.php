<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function export()
    {
        return view('pages.options.export');
    }
    public function import()
    {
        return view('pages.options.import');
    }
}
