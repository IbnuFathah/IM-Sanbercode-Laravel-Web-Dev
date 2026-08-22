<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Categories;

class CategoriesController extends Controller
{
    
    public function create()
    {
        return view('category.tambah');
    }

    public function store(Request $request)
    {
        //Validasi
        $request->validate([
            'name' => ['required', 'min:5'],
            'description' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        //Mengambil waktu saat ini untuk kolom crated_at dan updated_at
        $now = Carbon::now();

        //Insert data ke DB
        DB::table('categories')->insert([
            'name' => $request->input("name"),
            'description' => $request->input("description"),
            'created_at' => $now,
            'updated_at' => $now,
        ]);


        //Arahkan ke halaman Tampil semua genre 
        return redirect('/categories')->with('success', 'Category Berhasil ditambahkan!');


    }


    //Menampilkan seluruh daftar kategori yang ada di database
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('category.tampil', ['categories' => $categories]);
    }


    //Menampilkan detail satu kategori berdasarkan ID
    public function show($id)
    {
        $categories = Categories::find($id);
        return view('category.detail', ['categories' => $categories]);
    }


    //Menampilkan Form edit berdasarkan id yang dipilih untuk di edit
    public function edit($id)
    {
        $categories = DB::table('categories')->find($id);
        return view('category.edit', ['categories' => $categories]);
    }


    //Memproses perubahan data dari Form edit dan memperbarui di database
     public function update(Request $request, $id)
    {
        //Validation
        $request->validate([
            'name' => ['required', 'min:5'],
            'description' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        //Update data ke DB
        $now = Carbon::now();

        //Mengupdate kolom name, description dan updated_at berdasarkan ID yang dipilih 
        DB::table('categories')
        ->where('id', $id)
        ->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'updated_at' => $now,
                ]
            );


        //Arahkan kembali ke halaman Tampil semua genre dengan pesan succes
        return redirect('/categories')->with('success', 'Category Berhasil diubah!');



    }

    //Menghapus data kategori dari database berdasarkan ID
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return redirect('/categories')->with('success', 'Category Berhasil dihapus!');
    }
}
