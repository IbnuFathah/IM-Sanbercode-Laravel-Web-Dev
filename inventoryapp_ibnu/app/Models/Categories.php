<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //Memnetuka table mana yang dipilih
    protected $table = 'categories';

    //Daftar kolom yang bisa diakses untuk diisi
    protected $fillable = ['name','description'];

    public function product()
    {
        //Relasi One-to-Many, satu kategori bisa memiliki banyak product
        return $this->hasMany(Product::class, 'category_id');
    }
}
