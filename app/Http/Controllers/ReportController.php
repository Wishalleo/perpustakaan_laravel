<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Detail_Borrow;
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
    public function checkForfeit(Request $request, $code)
    {
        $cekDenda = Borrow::where('code', $code)->select('return_date')->get();
        // selisih
        $tglPengembalian = $cekDenda[0]->return_date;
        $hariIni = Carbon::today();
        $selisih = $hariIni->diff($tglPengembalian);
        
        if ($hariIni > $tglPengembalian) {
            $selisihAngka = $selisih->d;
            $denda = 500 * $selisihAngka;
            $request->session()->put('forfeit', $denda);
            return redirect()->back()->with('late', 'you are late');
        } else{            
            return redirect()->back()->with('discipline', 'you discipline');
        }
    }
    public function doneForfeit($code)
    {
        $selesaikan = Borrow::where('code', $code)
            ->update([
                'status'=>1
            ]);
        $kodeBuku = Detail_Borrow::where('code_borrow', $code)
            ->select('code_book')
            ->get();
        $kodeBuku[0]->code_book;
        $sedangDipinjam = Book::where('code', $kodeBuku[0]->code_book)->select('being_borrowed')->get();
        $sd = $sedangDipinjam[0]->being_borrowed - 1;
        $kurangiDipinjam = Book::where('code', $kodeBuku[0]->code_book)->select('being_borrowed')->update(['being_borrowed' => $sd]);
        return redirect()->back()->with('done', 'borrow solved');
    }
}
