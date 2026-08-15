@extends('layouts.master')
@section('title')
    Detail Categories
@endsection

@section('content')
    <h1 class="text-primary">{{$categories->name}}</h1>
    <p>{{$categories->description}}</p>
    <a href="/categories" class="btn btn-secondary btn-sm">Kembali</a>
@endsection