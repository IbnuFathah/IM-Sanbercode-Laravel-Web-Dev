@extends('layouts.master')
@section('title')
    Tambah Transaksi
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form method="post" action="/transactions" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label class="form-label">Product</label>
    <select name="product_id" id="" class="form-control">
      <option value="">-- Pilih Nama Product --</option>
      @forelse ($product as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
      @empty
        <option value="">Tidak ada Product</option>
      @endforelse
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Type</label>
    <select name="type" id="" class="form-control">
        <option value="">-- Pilih Tipe --</option>
        <option value="in">In</option>
        <option value="out">Out</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="number" name="amount" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection