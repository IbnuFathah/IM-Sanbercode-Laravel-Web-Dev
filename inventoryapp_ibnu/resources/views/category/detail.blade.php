@extends('layouts.master')
@section('title')
    Detail Categories
@endsection

@section('content')
    <h1 class="text-primary">{{$categories->name}}</h1>
    <p>{{$categories->description}}</p>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Stok</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($categories->product as $item)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->stock}}</td>
      <td><a href="/product/{{$item->id}}" class="btn btn-info btn-sm">Detail</a></td>
    </tr>
    @empty
    <tr>
        <td>Tidak ada Product di Categories ini</td>
    </tr>
    @endforelse
  </tbody>
</table>
    

    <button type="button" onclick="history.back()" class="btn btn-primary">Kembali</button>
@endsection