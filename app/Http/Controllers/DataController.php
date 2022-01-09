<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Moment;
use App\Models\UjiAnava;
use App\Models\UjiT;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function skor()
    {
        return view('pages.datalist.skor', [
            'min' => Data::min('nilai_1'),
            'max' => Data::max('nilai_1'),
            'mean' => number_format(Data::avg('nilai_1'), 2),
            'count' => Data::count('nilai_1'),
            'skor' => Data::paginate(6),
        ]);
    }

    public function skorTambah(Request $request)
    {
        $this->validate($request, [
            'nilai_1' => 'required'
        ]);
        Data::create([
            'nama' => '-',
            'nilai_1' => request('nilai_1'),
        ]);
        return redirect('/datalist/skor');
    }

    public function skorEdit(Request $request, $id)
    {
        $this->validate($request, [
            'nilai_1' => 'required'
        ]);
        Data::find($id)->update([
            'nilai_1' => request('nilai_1'),
        ]);
        return redirect('/datalist/skor');
    }

    public function skorDelete($id)
    {
        Data::destroy($id);
        return redirect()->back();
    }

    public function moment()
    {
        return view('pages.datalist.moment', [
            'moment' => Moment::paginate(7),
        ]);
    }

    public function ujit()
    {
        return view('pages.datalist.ujit', [
            'ujit' => UjiT::paginate(7),
        ]);
    }

    public function anava()
    {
        return view('pages.datalist.anava', [
            'anava' => UjiAnava::paginate(7),
        ]);
    }
}
