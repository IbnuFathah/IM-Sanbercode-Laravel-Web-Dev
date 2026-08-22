@extends('layouts.master')
@section('title')
    Detail Product
@endsection

@section('content')
<img src="{{asset('image/'.$product->image)}}" width="70%" alt="">
<h1 class="text-primary">{{$product->name}}</h1>
<p>stok: {{$product->stock}}</p>
<p>{{$product->description}}</p>
<a href="/product" class="btn btn-secondary btn-sm">Kembali</a>
@endsection