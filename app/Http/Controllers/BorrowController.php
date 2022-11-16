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
        $kodePeminjam = Borrow::where('code_borrow', $struk)
            ->select('code_user')
            ->get();
        $peminjam = Borrow::query()
            ->join('users', 'borrows.code_user', '=', 'users.code')
            ->select('users.name')
            ->where('borrows.code_borrow', $struk)
            ->get();
        $isi = Detail_Borrow::query()
            ->join('books', 'detail_borrows.code_book', '=', 'books.code')
            ->join('borrows', 'detail_borrows.code_borrow', '=', 'borrows.code_borrow')
            ->select('detail_borrows.code_book as code', 'books.title', 'borrows.code_user', 'detail_borrows.id')
            ->where('detail_borrows.code_borrow', $struk)
            ->get();
        // return $isi;
        return view('layouts.borrow.my-borrow', ['isi' => $isi, 'peminjam' => $peminjam, 'kodePeminjam' => $kodePeminjam]);
    }

    public function checkMember(Request $request)
    {
        $struk = $request->session()->get('code_borrow');
        $cekAnggota = User::where('code', $request->code)->count();
        if ($cekAnggota > 0) {
            $inputKode = Borrow::where('code_borrow', $struk)
                ->update([
                    'code_user' => $request->code
                ]);
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'User Not Found');
        }
    }

    public function addCart(Request $request)
    {
        $struk = $request->session()->get('code_borrow');
        $cekMember = Borrow::query()
            ->join('detail_borrows', 'borrows.code_borrow', '=', 'detail_borrows.code_borrow')
            ->where('detail_borrows.code_book', $request->code)
            ->where('borrows.code_user', $request->code_user)
            ->where('borrows.status', 0)
            ->count();
        $cekBuku = Book::where('code', $request->code)->count();
        if ($cekBuku > 0 && $request->code_user == null) {
            return redirect()->back()->with('user', 'User Empty');
        } else if ($cekBuku == 0) {
            return redirect()->back()->with('message', 'Not Found');
        } else if ($cekMember > 0 || $request->code_user == 0) {
            return redirect()->back()->with('use', 'book is in use');
        } else {
            $tambahBuku = Detail_Borrow::create([
                'code_borrow' => $struk,
                'code_book' => $request->code,
            ]);
            $sedangDipinjam = Book::where('code', $request->code)->select('being_borrowed')->get();
            $sd = $sedangDipinjam[0]->being_borrowed + 1;
            $kurangiDipinjam = Book::where('code', $request->code)->select('being_borrowed')->update(['being_borrowed' => $sd]);
            $isiTanggal = Borrow::where('code_borrow', $struk)
                ->update([
                    'return_date' => Carbon::today()->addDays(7)
                ]);
            return redirect()->back();
        }
    }

    public function deleteCart($id)
    {
        $deleteBukuPinjam = Detail_Borrow::findOrFail($id);
        $code_book = Detail_Borrow::findOrFail($id)
            ->select('code_book')
            ->get();
        $sedangDipinjam = Book::where('code', $code_book[0]->code_book)->select('being_borrowed')->get();
        $sd = $sedangDipinjam[0]->being_borrowed - 1;
        $kurangiDipinjam = Book::where('code', $code_book[0]->code_book)->select('being_borrowed')->update(['being_borrowed' => $sd]);
        $deleteBukuPinjam->delete();
        return redirect()->back();
    }

    public function addBorrow(Request $request)
    {
        $struk = $request->session()->get('code_borrow');
        $tgl_kembali = Carbon::today()->addDays($request->return_date);
        $updatePinjam = Borrow::where('code_borrow', $struk)
            ->update([
                'return_date' => $tgl_kembali
            ]);
        return view('dashboard');
    }
}
