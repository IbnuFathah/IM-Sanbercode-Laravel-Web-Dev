<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('category.tambah');
    }

    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'name' => ['required', 'min:5'],
            'description' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        //Insert data ke DB
        $now = Carbon::now();
        DB::table('categories')->insert([
            'name' => $request->input("name"),
            'description' => $request->input("description"),
            'created_at' => $now,
            'updated_at' => $now,
        ]);


        //Arahkan ke halaman Tampil semua genre 
        return redirect('/categories')->with('success', 'Category Berhasil ditambahkan!');




        return $request->all();
    }
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('category.tampil', ['categories' => $categories]);
    }

    public function show($id)
    {
        $categories = DB::table('categories')->find($id);
        return view('category.detail', ['categories' => $categories]);
    }
    public function edit($id)
    {
        $categories = DB::table('categories')->find($id);
        return view('category.edit', ['categories' => $categories]);
    }
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

        DB::table('categories')
        ->where('id', 1)
        ->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'update_at' => $now,
                ]
            );


        //Arahkan ke halaman Tampil semua genre 
        return redirect('/categories')->with('success', 'Category Berhasil diubah!');




        return $request->all();

    }
}
