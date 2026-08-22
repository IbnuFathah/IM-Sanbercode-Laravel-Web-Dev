@extends('layouts.master')
@section('title')
    Tambah Profile
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

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-800 dark:text-green-400" role="alert">
          {{ session('success') }}
        </div>
    @endif

<form method="POST" action="/profile">
    @csrf
  <div class="mb-3">
    <label class="form-label">Age</label>
    <input type="number" name="age" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Bio</label>
    <textarea name="bio" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection