@extends('layouts.master')
@section('title')
    Tampil Categories
@endsection

@section('content')
    <a href="categories/create" class="btn btn-primary btn-sm my-3">Create</a>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
    @endif
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($categories as $item)
        <tr>
           <th scope="row">{{$loop->iteration}}</th>
           <td>{{$item->name}}</td>
           <td>
                <form action="/categories/{{$item->id}}" method="POST">
                @method("DELETE")
                @csrf
                <a href="/categories/{{$item->id}}" class="btn btn-info btn-sm">Detail</a>
                <a href="/categories/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
           </td>
        </tr>
    @empty
        <tr>
          <td>Category Masih Kosong</td>
        </tr>
    @endforelse
    
  </tbody>
</table>
@endsection