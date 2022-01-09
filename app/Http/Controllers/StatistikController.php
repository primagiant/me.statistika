<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\FTable;
use App\Models\Moment;
use App\Models\TTable;
use App\Models\UjiAnava;
use App\Models\UjiT;
use App\Models\ZTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function frequensi()
    {
        $max = Data::max('nilai_1');
        $min = Data::min('nilai_1');
        $count = Data::count('nilai_1');
        $mean = number_format(Data::average('nilai_1'), 2);
        $frek = Data::select('nilai_1 as nilai', DB::raw('count(*) as frek'))->groupBy('nilai_1')->get();
        return view('pages.statistika.frequensi', [
            'max' => $max,
            'min' => $min,
            'mean' => $mean,
            'count' => $count,
            'frek' => $frek
        ]);
    }

    public function bergolong()
    {
        $valMax = Data::max('nilai_1');
        $valMin = Data::min('nilai_1');

        $range = $valMax - $valMin;

        $dataNum = Data::count('nilai_1');

        $class = ceil(3.3 * log10($dataNum) + 1);
        $interval = ceil($range / $class);

        $botlimit = $valMin;
        $toplimit = 0;

        for ($i = 0; $i < $class; $i++) {
            $toplimit = $botlimit + $interval - 1;
            $frek[$i] = Data::select(DB::raw('count(*) as frekuensi, nilai_1'))
                ->where([['nilai_1', '>=', $botlimit], ['nilai_1', '<=', $toplimit]])
                ->count();

            $data[$i] =  $botlimit . '-' . $toplimit;
            $botlimit = $toplimit + 1;
        }
        return view('pages.statistika.bergolong', [
            'class' => $class,
            'data' => $data,
            'frek' => $frek
        ]);
    }

    public function chi()
    {
        $valMax = Data::max('nilai_1');
        $valMin = Data::min('nilai_1');
        $dataNum = Data::count('nilai_1');
        $avg = number_format(Data::average('nilai_1'), 2);

        $Data = Data::select('nilai_1')->get();
        $index = 0;

        foreach ($Data as $x) {
            $dataArr[$index] = $x->nilai_1;
            $index++;
        }

        $Sdev = number_format($this->std_dev($dataArr), 2);

        $range = $valMax - $valMin;
        $class = ceil(3.3 * log10($dataNum) + 1);
        $interval = ceil($range / $class);
        $botlimit = $valMin;
        $toplimit = 0;

        $chi = 0;
        for ($i = 0; $i < $class; $i++) {
            $toplimit = $botlimit + $interval - 1;

            $botlim[$i] = $botlimit - 0.5;
            $toplim[$i] = $toplimit + 0.5;

            $botZval[$i] = number_format(($botlim[$i] - $avg) / $Sdev, 2);
            $topZval[$i] = number_format(($toplim[$i] - $avg) / $Sdev, 2);

            $zbot = ZTable::where('z', '=', $this->decimal($botZval[$i]))->get();
            $ztop = ZTable::where('z', '=', $this->decimal($topZval[$i]))->get();

            $tmp = $this->label($botZval[$i]);
            $zTabelBot[$i] = $zbot[0]->$tmp;
            $tmp = $this->label($topZval[$i]);
            $zTabelTop[$i] = $ztop[0]->$tmp;

            $Lpps[$i] = abs($zTabelBot[$i] - $zTabelTop[$i]);

            $Fe[$i] = $Lpps[$i] * $dataNum;

            $frek[$i] = Data::select(DB::raw('count(*) as frekuensi, nilai_1'))
                ->where([['nilai_1', '>=', $botlimit], ['nilai_1', '<=', $toplimit]])
                ->count();

            $data[$i] =  $botlimit . '-' . $toplimit;
            $botlimit = $toplimit + 1;

            $kai[$i] = number_format(pow(($frek[$i] - $Fe[$i]), 2) / $Fe[$i], 7);
            $chi += $kai[$i];
        }
        return view('pages.statistika.chi', [
            'class' => $class,
            'data' => $data,
            'frek' => $frek,
            'botlim' => $botlim,
            'toplim' => $toplim,
            'botZval' => $botZval,
            'topZval' => $topZval,
            'zTabelBot' => $zTabelBot,
            'zTabelTop' => $zTabelTop,
            'Lpps' => $Lpps,
            'Fe' => $Fe,
            'kai' => $kai,
            'chi' => $chi
        ]);
    }

    public function lilliefors()
    {
        $dataNum = Data::count('nilai_1');
        $avg = number_format(Data::average('nilai_1'), 2);

        $Data = Data::select('nilai_1')->get();
        $index = 0;
        foreach ($Data as $x) {
            $dataArr[$index] = $x->nilai_1;
            $index++;
        }

        $Sdev = number_format($this->std_dev($dataArr), 2);

        for ($i = 0; $i < $dataNum; $i++) {
            $frek[$i] = Data::select('nilai_1', DB::raw('count(*) as frekuensi'))
                ->groupBy('nilai_1')
                ->get();
            $countData = count($frek[$i]);
        }

        $totalfrek = 0;
        $totalLLF = 0;
        for ($i = 0; $i < $countData; $i++) {

            $totalfrek += $frek[0][$i]->frekuensi;
            $frekKum[$i] = $totalfrek;

            $Zi[$i] = number_format(($frek[0][$i]->nilai_1 - $avg) / $Sdev, 2);
            $Zrow = ZTable::where('z', '=', $this->decimal($Zi[$i]))->get();
            $tmp = $this->label($Zi[$i]);
            $F_zi[$i] = $Zrow[0]->$tmp;

            $S_zi[$i] = number_format($frekKum[$i] / $dataNum, 5);

            $LLF[$i] = abs($F_zi[$i] - $S_zi[$i]);
            $totalLLF = $LLF[$i];
        }
        return view('pages.statistika.lilliefors', [
            'frek' => $frek,
            'countData' => $countData,
            'frekKum' => $frekKum,
            'Zi' => $Zi,
            'F_zi' => $F_zi,
            'S_zi' => $S_zi,
            'LLF' => $LLF,
            'totalLLF' => $totalLLF,
            'dataNum' => $dataNum
        ]);
    }

    public function moment()
    {
        $moments = Moment::all();
        $countX = Moment::count('x');

        $avgX = Moment::average('x');
        $avgY = Moment::average('y');

        $sumX = Moment::sum('x');
        $sumY = Moment::sum('y');

        $sumXSqr = 0;
        $sumYSqr = 0;
        $sumXY = 0;
        for ($i = 0; $i < $countX; $i++) {

            $xmin[$i] = $moments[$i]->x - $avgX;
            $ymin[$i] = $moments[$i]->y - $avgY;

            $xSqr[$i] = $xmin[$i] * $xmin[$i];
            $sumXSqr += $xSqr[$i];

            $ySqr[$i] = $ymin[$i] * $ymin[$i];
            $sumYSqr += $ySqr[$i];

            $XY[$i] = $xmin[$i] * $ymin[$i];
            $sumXY += $XY[$i];
        }
        $corelation = $sumXY / sqrt($sumXSqr * $sumYSqr);

        return view('pages.statistika.moment', [
            'moments' => $moments,
            'xmin' => $xmin,
            'ymin' => $ymin,
            'xSqr' => $xSqr,
            'ySqr' => $ySqr,
            'XY' => $XY,
            'sumX' => $sumX,
            'sumY' => $sumY,
            'sumXSqr' => $sumXSqr,
            'sumYSqr' => $sumYSqr,
            'sumXY' => $sumXY,
            'avgX' => $avgX,
            'avgY' => $avgY,
            'corelation' => $corelation,
        ]);
    }

    public function ujit()
    {
        $ujiT = UjiT::all();
        $avgx1 = UjiT::average('x1');
        $avgx2 = UjiT::average('x2');
        $n1 = UjiT::count('x1');
        $n2 = UjiT::count('x2');

        $count = UjiT::count();

        $x1 = UjiT::select('x1')->get();
        $x2 = UjiT::select('x2')->get();


        $i = 0;
        foreach ($x1 as $a) {
            $arrX1[$i] = $a->x1;
            $i++;
        }
        $j = 0;
        foreach ($x2 as $b) {
            $arrX2[$j] = $b->x2;
            $j++;
        }

        $sdX1 = number_format($this->std_dev($arrX1), 2);
        $sdX2 = number_format($this->std_dev($arrX2), 2);


        $variansX1 = pow($sdX1, 2);
        $variansX2 = pow($sdX2, 2);

        $sumX1Sqr = 0;
        $sumX2Sqr = 0;
        $sumX1X2 = 0;

        for ($i = 0; $i < $count; $i++) {

            $x1corel[$i] = $ujiT[$i]->x1 - $avgx1;
            $x2corel[$i] = $ujiT[$i]->x2 - $avgx2;

            $x1Sqr[$i] = $x1corel[$i] * $x1corel[$i];
            $sumX1Sqr += $x1Sqr[$i];

            $x2Sqr[$i] = $x2corel[$i] * $x2corel[$i];
            $sumX2Sqr += $x2Sqr[$i];

            $x1x2[$i] = $x1corel[$i] * $x2corel[$i];
            $sumX1X2 += $x1x2[$i];
        }


        $corelmoment = number_format($sumX1X2 / sqrt($sumX1Sqr * $sumX2Sqr), 2);
        $resUjiT = number_format($avgx1 - $avgx2 / sqrt((($variansX1 / $n1) + ($variansX2 / $n2)) - 2 * $corelmoment * (($sdX1 / sqrt($n1)) * ($sdX2 / sqrt($n2)))), 2);
        $df = $count - 1;
        $labelnilai = "limapersen";
        $kolom = TTable::where('df', '=', $df)->get();
        $TTabel = $kolom[0]->$labelnilai;

        if ($resUjiT < $TTabel) {
            $status =  "Diterima";
        } else {
            $status =   "Tidak Diterima";
        }
        return view('pages.statistika.ujit', [
            'ujiT' => $ujiT,
            'avgx1' => $avgx1,
            'avgx2' => $avgx2,
            'variansX1' => $variansX1,
            'variansX2' => $variansX2,
            'sdX1' => $sdX1,
            'sdX2' => $sdX2,
            'resUjiT' => $resUjiT,
            'TTabel' => $TTabel,
            'status' => $status
        ]);
    }

    public function anava()
    {
        $Anava = UjiAnava::all();
        $count = UjiAnava::count();

        $sumX1 = UjiAnava::sum('x1');
        $sumX2 = UjiAnava::sum('x2');
        $sumX3 = UjiAnava::sum('x3');

        $avgX1 = UjiAnava::avg('x1');
        $avgX2 = UjiAnava::avg('x2');
        $avgX3 = UjiAnava::avg('x3');

        $nx1 = UjiAnava::count('x1');
        $nx2 = UjiAnava::count('x2');
        $nx3 = UjiAnava::count('x3');

        $total = $nx1 + $nx2 + $nx3;

        $k = 4;

        $sigmaX1Sqr = 0;
        $sigmaX2Sqr = 0;
        $sigmaX3Sqr = 0;
        $sigmaXtotal = 0;
        $sigmaXtotalSqr = 0;

        for ($i = 0; $i < $count; $i++) {
            $X1Sqr[$i] = $Anava[$i]->x1 * $Anava[$i]->x1;
            $X2Sqr[$i] = $Anava[$i]->x2 * $Anava[$i]->x2;
            $X3Sqr[$i] = $Anava[$i]->x3 * $Anava[$i]->x3;


            $sigmaX1Sqr += $X1Sqr[$i];
            $sigmaX2Sqr += $X2Sqr[$i];
            $sigmaX3Sqr += $X3Sqr[$i];

            $Xtotal[$i] = $Anava[$i]->x1 + $Anava[$i]->x2 + $Anava[$i]->x3;
            $XtotalSqr[$i] =  $Xtotal[$i] * $Xtotal[$i];

            $sigmaXtotal += $Xtotal[$i];
            $sigmaXtotalSqr += $XtotalSqr[$i];
        }

        if ($nx1 !== 0) {
            $a1 =  ($sumX1 / $nx1);
        } else {
            $a1 = 0;
        }

        if ($nx2 !== 0) {
            $a2 =  ($sumX2 / $nx2);
        } else {
            $a2 = 0;
        }


        if ($nx3 !== 0) {
            $a3 =  ($sumX3 / $nx3);
        } else {
            $a3 = 0;
        }

        if ($total !== 0) {
            $a5 =  ($sigmaXtotal / $total);
        } else {
            $a5 = 0;
        }

        $JKA =  $a1 + $a2 + $a3 + -$a5;

        $DKA = $k - 1;

        if ($DKA !== 0) {
            $RJKA = $JKA / $DKA;
        } else {
            $RJKA = 0;
        }

        $sigmaYSqr = $sigmaX1Sqr + $sigmaX2Sqr + $sigmaX3Sqr;

        if ($total !== 0) {
            $JKT = $sigmaYSqr - (($sigmaXtotal * $sigmaXtotal) / $total);
        } else {
            $JKT = 0;
        }

        $JKD = $JKT - $JKA;


        $DKD = $total - $k;


        if ($DKD !== 0) {
            $RJKD = $JKD / $DKD;
        } else {
            $RJKD = 0;
        }

        if ($RJKD !== 0) {
            $F = $RJKA / $RJKD;
        } else {
            $F = 0;
        }

        $DKT = $DKD + $DKA;

        //1. cek label
        $labelDKA = $this->labelAnava($DKA);

        //2. cek di tabel f
        $kolom = FTable::where('df1', '=', $DKD)->get();
        $fTabel = $kolom[0]->$labelDKA;

        //cek keterangan
        if ($F > $fTabel) {
            $status =  "Signifikan";
        } else {
            $status =   "Tidak Signifikan";
        }
        return view('pages.statistika.anava', [
            'Anava' => $Anava,
            'count' => $count,
            'X1Sqr' => $X1Sqr,
            'X2Sqr' => $X2Sqr,
            'X3Sqr' => $X3Sqr,
            'Xtotal' => $Xtotal,
            'XtotalSqr' => $XtotalSqr,
            'sumX1' => $sumX1,
            'sumX2' => $sumX2,
            'sumX3' => $sumX3,
            'sigmaX1Sqr' => $sigmaX1Sqr,
            'sigmaX2Sqr' => $sigmaX2Sqr,
            'sigmaX3Sqr' => $sigmaX3Sqr,
            'sigmaXtotal' => $sigmaXtotal,
            'sigmaXtotalSqr' => $sigmaXtotalSqr,
            'avgX1' => $avgX1,
            'avgX2' => $avgX2,
            'avgX3' => $avgX3,
            'JKA' => $JKA,
            'DKA' => $DKA,
            'RJKA' => $RJKA,
            'F' => $F,
            'fTabel' => $fTabel,
            'status' => $status,
            'JKD' => $JKD,
            'DKD' => $DKD,
            'RJKD' => $RJKD,
            'JKT' => $JKT,
            'DKT' => $DKT,
        ]);
    }

    //Processing Z table
    private function decimal($nilai)
    {
        if ($nilai < 0) {
            $des = substr($nilai, 0, 4);
        } else {
            $des = substr($nilai, 0, 3);
        }
        return $des;
    }

    private function label($nilai)
    {
        if ($nilai < 0) {
            $str1 = substr($nilai, 4, 1);
        } else {
            $str1 = substr($nilai, 3, 1);
        }
        $Lable = ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $sLabel = $Lable[$str1];

        return $sLabel;
    }

    private function labelAnava($index)
    {
        $col_label = ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima'];
        $Label =  $col_label[$index];
        return $Label;
    }

    private function std_dev($array)
    {
        $length = count($array);
        $tmp = 0.0;
        $avg = array_sum($array) / $length;
        foreach ($array as $i) {
            $tmp += pow(($i - $avg), 2);
        }
        return (float)sqrt($tmp / $length);
    }
}
