<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $dataTransaksi = Borrow::query()
            ->join('detail_borrows', 'borrows.code', '=', 'detail_borrows.code_borrow')
            ->join('users', 'borrows.code_user', '=', 'users.code')
            ->select('borrows.code', 'borrows.created_at', 'users.name', 'borrows.operator', 'borrows.return_date', 'borrows.status')
            ->orderBy('status', 'asc')
            ->get();
        // return $dataTransaksi;
        return view('layouts.report.transaction-report', ['data' => $dataTransaksi, 'dataStruk' => []]);
    }
    public function checkForfeit($code)
    {
        $cekDenda = Borrow::where('code', $code)->select('return_date')->get();
        // selisih
        $tglPengembalian = $cekDenda[0]->return_date;
        $hariIni = Carbon::today();
        $selisih = $hariIni->diff($tglPengembalian);
        
        if ($hariIni > $tglPengembalian) {
            $selisihAngka = $selisih->d;
            $denda = 500 * $selisihAngka;
            return redirect()->back()->with('forfeit', 'you are late');
        } else{            
            return redirect()->back()->with('done', 'you discipline');
        }
    }
    public function submitBorrow()
    {
        
    }
}
