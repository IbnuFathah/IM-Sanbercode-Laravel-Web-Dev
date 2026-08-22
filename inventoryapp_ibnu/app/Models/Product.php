<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Memilih table product dari database yang digunakan
    protected $table = 'products';

    //Daftar kolom yang bisa diakses untuk diisi
    protected $fillable = ['name','image','description','price','stock','category_id'];

    public function categories()
    {
        //Relasi Many-to-One, Banyak produk bisa dimiliki satu kategori
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
