<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Detail_Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $opr = Auth::user()->name;
        $tgl = date('dmY');
        $tgl_pinjam = Carbon::today();
        // $tgl_kembali = Carbon::today()->addDays(7);
        // ->translatedFormat('d F Y')
        $data = Borrow::query()->where('operator', $opr)->count();
        $ke = $data + 1;
        $code_borrow = $tgl . "/" . $opr . "/" . $ke;
        Borrow::query()->create([
            'code_borrow' => $code_borrow,
            'operator' => $opr,
            'status' => 0,
            'borrow_date' => $tgl_pinjam,
        ]);
        $request->session()->put('code_borrow', $code_borrow);
        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $struk = $request->session()->get('code_borrow');
        $peminjam = Borrow::query()
            ->join('users', 'borrows.code_user', '=', 'users.code')
            ->select('users.name')
            ->where('borrows.code_borrow', $struk)
            ->get();
        $isi = Detail_Borrow::query()
            ->join('books', 'detail_borrows.code_book', '=', 'books.code')
            ->join('borrows', 'detail_borrows.code_borrow', '=', 'borrows.code_borrow')
            ->select('detail_borrows.code_book as code', 'books.title','borrows.code_user')
            ->where('detail_borrows.code_borrow', $struk)
            ->get();
        // return $isi;
        return view('layouts.borrow.my-borrow', ['isi' => $isi,'peminjam' =>$peminjam]);
    }

    public function checkMember(Request $request)
    {
        // return User::where('code', $request->code)->get();        
        $inputKode = Borrow::where('code_borrow', $request->session()->get('code_borrow'))
            ->update([
                'code_user' => $request->code
            ]);
        return redirect('cart');
    }

    public function addCart(Request $request)
    {
        $cekMember = Borrow::where('code_borrow',$request->session()->get('code_borrow'))->where('code_user',$request->code)->count();
        if($cekMember>0){
            $tambahBuku = Detail_Borrow::create([
                'code_borrow' => $request->session()->get('code_borrow'),
                'code_book' => $request->code,
            ]);
            return redirect('cart');
        }
        return redirect('cart');
    }

    public function deleteCart(Request $request)
    {
        //
    }

    public function addBorrow(Request $request)
    {
        $tgl_kembali = Carbon::today()->addDays($request->return_date);
        $updatePinjam = Borrow::where('code_borrow', $request->session()->get('code_borrow'))
            ->update([
                'return_date' => $tgl_kembali
            ]);
        $updateBuku = Book::where('code', $request->code)
        ->update([
            'status'=>1
        ]);
        return view('dashboard');
    }
}
