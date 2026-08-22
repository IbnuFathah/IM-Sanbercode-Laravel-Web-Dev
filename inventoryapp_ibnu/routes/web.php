<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TestExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [DashboardController::class, 'home'])->middleware('auth');

Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'store'])->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth');


//Hanya admin role yang bisa akses
Route::middleware(['auth', 'admin'])->group(function () {
    //CRUD categories
    //C => Create
    Route::get('/categories/create', [CategoriesController::class, 'create']);
    Route::post('/categories', [CategoriesController::class, 'store']);

    //R => Read Data
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::get('/categories/{id}', [CategoriesController::class, 'show']);

    //U => Update Data
    Route::get('/categories/{id}/edit',[CategoriesController::class, 'edit']);
    Route::put('/categories/{id}',[CategoriesController::class, 'update']);

    //D => Delete
    Route::delete('/categories/{id}',[CategoriesController::class, 'destroy']);
});



//CRUD -> Product
Route::resource('/product',ProductController::class); //Hanya role admin yang bisa melakukan aktivitas Creat,Update & Delete karena sudah dikasih logic di Controller/Blade


Route::middleware(['guest'])->group(function () {
    //AUTH
    //Register
    Route::get('/register', [AuthController::class, 'formregister']);
    Route::post('/register', [AuthController::class, 'register']);

    //Login
    Route::get('/login', [AuthController::class, 'formlogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
}); 

//Logout
Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    // Get List Transaksi
    Route::get('/transactions', [TransactionsController::class, 'index']);

    //C => Create
    Route::get('/transactions/create', [TransactionsController::class, 'create']);
    Route::post('/transactions', [TransactionsController::class, 'store']);

    //Admin
    Route::put('/transactions/{id}', [TransactionsController::class, 'update']);
});

//Tes DOMPDF
Route::get('/test-pdf', function () {
    $html = '<h1>Test PDF!</h1><p>Mencoba File PDF di libary Laravel</p>';
    $pdf = Pdf::loadHTML($html);
    
    return $pdf->stream('tes-dompdf.pdf');
});

//Test Excel
Route::get('/test-excel', function () {
    return Excel::download(new TestExport, 'tes-excel.xlsx');
});
