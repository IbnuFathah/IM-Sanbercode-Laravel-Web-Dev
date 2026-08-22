<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{

    //Menampilkan riwayat transaksi
    public function index()
    {
        //Menambahkan logic untuk role admin untuk bisa melihat aktivitas transaksi dari semua user
        $user = Auth::user();
        if ($user->role === 'admin'){
            $transactions = Transactions::get();
        }else{
            $transactions = Transactions::where('user_id', $user->id)->get();
        }

        return view('transactions.index', ['transactions'=>$transactions]);
    }


    public function create()
    {
        $product = Product::get();
        return view('transactions.create', ['product' => $product]);
    }


    //Memperbarui jumlah stok produk
    public function store(Request $request)
    {
         $request->validate([
            'product_id' => ['required',],
            'type' => ['required'],
            'amount' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        $id_user = Auth::user()->id;
        // Menyimpan data transaksi baru
        $transactions = new Transactions;
        $transactions->product_id = $request->input('product_id');
        $transactions->type = $request->input('type');
        $transactions->amount = $request->input('amount');
        $transactions->notes = $request->input('notes');
        $transactions->user_id = $id_user;

        $transactions->save();
        //Update Stok produk
        $product = Product::find($request->product_id);
        //Memberikan logic, jika dipilih in maka akan menambahkan sesuai jumlah yang ditentukan, jika out maka akan mengurangi sesuai jumlah yang ditentukan  
        if($request->type == 'in'){
            $product->increment ('stock', $request->amount); 
        }else{
            $product->decrement ('stock', $request->amount);
        }

        return redirect('/transactions')->with('success', 'Transaksi Berhasil!');
    }
}
