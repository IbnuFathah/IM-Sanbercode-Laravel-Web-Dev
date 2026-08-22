<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use File;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{

    //middlewere digunakan untun membatasi hak akses role, hanya role admin yang bisa memodifikasi data product, 
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin', except: ['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    

    //Menampilkan data Product
    public function index()
    {
        //Mengambil semua data produk dari database
        $product = Product::get();

        return view('product.tampil', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     */


    //Membuka halaman penambahan Product
    public function create()
    {
        $categories = Categories::get(); 
        return view('product.tambah', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */

    
    //Proses Menyimpan/Menambah data ke database 
    public function store(Request $request)
    {
        //Validasi
        $request->validate([
            //Memastikan inputan sesuai aturan
            'name' => ['required', 'min:5'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'category_id' => ['required'],
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        //Membuat nama gambar unik menggunakan waktu agar tidak terjadi replace
        $imageName = time().'.'.$request->image->extension();

        //Memasukan file gambar yang di unggah ke folder public/image
        $request->image->move(public_path('image'), $imageName);

        // Menyimpan data produk baru ke database menggunakan Eloquent ORM
        $product = new product;
 
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');
        $product->image = $imageName;
 
        $product->save();
 
        return redirect('/product')->with('success', 'Product Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Menampilkan detail produk berdasarkan id yang dipilih
        $product = Product::findOrFail($id);

        return view('product.detail', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //Mengambil data produk yang dipilih untuk ditampilkan/masukkan ke form edit
        $product = Product::find($id);
        $categories = Categories::get(); 
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Validasi, memastikan tidak diluar aturan
          $request->validate([
            'name' => ['required', 'min:5'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'category_id' => ['required'],
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

         
        $product = Product::find($id);

        //Membuat logic untuk cek apakah user mengunggahh file gambar baru
        if($request->hasFile('image')){
            if($product->image){
                //Menghapus gambar sebelumnya
                if(File::exists(public_path('image/'. $product->image))){
                    File::delete(public_path('image/'. $product->image));
                }

                //menyimpan file gambar baru
                $imageName = time().'.'.$request->image->extension();

                $request->image->move(public_path('image'), $imageName);

                $product->image = $imageName;
            }
        }
        //Memperbarui data produk
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');

        $product->save();

        return redirect('/product')->with('success', 'Product Berhasil diubah !');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
 
        //Menghapus file gambar di direktori public
        if($product->image){
            if(File::exists(public_path('image/'. $product->image))){
                File::delete(public_path('image/'. $product->image));
            }
        }
        $product->delete();

        return redirect('/product')->with('success', 'Product Berhasil dihapus !');;
    }
}
