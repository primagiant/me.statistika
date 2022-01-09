<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Exports\MomentExport;
use App\Exports\UjiAnavaExport;
use App\Exports\UjiTExport;
use App\Imports\DataImport;
use App\Imports\MomentImport;
use App\Imports\UjiAnavaImport;
use App\Imports\UjiTImport;
use App\Models\Data;
use App\Models\Moment;
use App\Models\UjiAnava;
use App\Models\UjiT;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public  function exportSkor()
    {
        return Excel::download(new DataExport, 'Data_Skor.xlsx');
    }

    public  function exportMoment()
    {
        return Excel::download(new MomentExport, 'Data_Product_Moment.xlsx');
    }

    public  function exportUjiT()
    {
        return Excel::download(new UjiTExport, 'Data_Uji_T.xlsx');
    }

    public  function exportUjiAnava()
    {
        return Excel::download(new UjiAnavaExport, 'Data_Uji_Anava.xlsx');
    }

    public function importSkor(Request $request)
    {
        Excel::import(new DataImport, $request->file('file'));
        return redirect('/datalist/skor');
    }

    public function importMoment(Request $request)
    {
        Excel::import(new MomentImport, $request->file('file'));
        return redirect('/datalist/moment');
    }

    public function importUjiT(Request $request)
    {
        Excel::import(new UjiTImport, $request->file('file'));
        return redirect('/datalist/ujit');
    }

    public function importUjiAnava(Request $request)
    {
        Excel::import(new UjiAnavaImport, $request->file('file'));
        return redirect('/datalist/anava');
    }

    public function truncateSkor()
    {
        Data::truncate();
        return redirect('/datalist/skor');
    }

    public function truncateMoment()
    {
        Moment::truncate();
        return redirect('/datalist/moment');
    }

    public function truncateUjit()
    {
        UjiT::truncate();
        return redirect('/datalist/ujit');
    }

    public function truncateUjiAnava()
    {
        UjiAnava::truncate();
        return redirect('/datalist/anava');
    }
}
