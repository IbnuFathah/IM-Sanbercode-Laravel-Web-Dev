@extends('layouts.master')
@section('title')
    Daftar Product
@endsection

@section('content')

@if (session()->has('success'))
   <div class="alert alert-success" role="alert">
     {{ session('success') }}
    </div>
@endif

@if (Auth::check() && Auth::user()->role === 'admin')
<a href="/product/create" class="btn btn-sm btn-primary my-3">Tambah</a>
@endif

<div class="row">
    @forelse ($product as $item)
        <div class="col-4">
            <div class="card">
                <img src="{{asset('image/'.$item->image)}}" height="200px" class="card-img-top" alt="...">
                <div class="card-body">
                    <span class="badge text-bg-info">{{$item->categories->name}}</span>
                    <h5 class="card-title">{{$item->name}}</h5> 
                    <span class="text-primary-emphasis"><b>{{$item->price}}</b></span><br>
                    <span class="text-primary-emphasis">Total Stok: {{$item->stock}}</span>
                    <p class="card-text">{{Str::limit($item->description, 60)}}</p>
                    <div class="d-grid">
                        <a href="/product/{{$item->id}}" class="btn btn-primary">Selengkapnya</a>
                    </div>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="row my-3">
                        <div class="col">
                            <div class="d-grid">
                                <a href="/product/{{$item->id}}/edit" class="btn btn-warning">Edit</a>
                            </div>
                        </div>
                        <div class="col">
                                <form action="/product/{{$item->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <div class=" d-grid">
                                    <input type="submit" value="DELETE" class="btn btn-danger ">
                                </div>
                                </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <h2>Produk masih kosong</h2>
    @endforelse
</div>
@endsection