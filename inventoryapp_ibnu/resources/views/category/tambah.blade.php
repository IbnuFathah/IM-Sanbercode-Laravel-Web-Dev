@extends('layouts.master')
@section('title')
    Tambah Categories
@endsection

@section('content')
<form method="post" action="/categories">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @csrf
    @endif
  <div class="mb-3">
    <label class="form-label">Category Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection