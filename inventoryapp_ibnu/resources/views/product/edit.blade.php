@extends('layouts.master')
@section('title')
    Edit Product
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

<form method="post" action="/product/{{$product->id}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
  <div class="mb-3">
    <label class="form-label">Product Name</label>
    <input type="text" name="name" class="form-control" value="{{old('name', $product->name)}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="10">{{old('description', $product->description)}}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" name="price" class="form-control" value="{{old('price', $product->price)}}">
  </div>
  <div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control" value="{{old('stock', $product->stock)}}">
  </div>
  <div class="mb-3">
    <label class="form-label">Categories</label>
    <select name="category_id" id="" class="form-control">
      <option value="">-- Pilih Categories --</option>
      @forelse ($categories as $item)
        @if ($item->id === $product->category_id)
            <option value="{{$item->id}}" selected>{{$item->name}}</option>
        @else
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endif
      @empty
        <option value="">Tidak ada Categories</option>
      @endforelse
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Change Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Ubah</button>
</form>
@endsection