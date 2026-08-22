<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //Memilih table transactions dari database yang digunakan
    protected $table = 'transactions';

    //Daftar kolom yang bisa diakses untuk diisi
    protected $fillable = ['product_id', 'user_id', 'type', 'amount', 'notes'];

    public function user()
    {
        // Relasi Many-to-One, banyak transaksi bisa dimiliki oleh 1 User
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        // Relasi Many-to-One, banyak transaksi bisa terhubung ke 1 Produk
        return $this->belongsTo(Product::class, 'product_id');
    }
}
