@extends('layouts.master')
@section('title')
    Edit Categories
@endsection

@section('content')
<form method="post" action="/categories/{{$categories->id}}">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    @method("PUT")
  <div class="mb-3">
    <label class="form-label">Category Name</label>
    <input type="text" name="name" value="{{$categories->name}}" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="10">{{$categories->description}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
  <button type="button" onclick="history.back()" class="btn btn-primary">Kembali</button>
</form>
@endsection