@extends('layouts.master')
@section('title')
    Tampil Categories
@endsection

@section('content')
    <a href="categories/create" class="btn btn-primary btn-sm my-3">Create</a>

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-800 dark:text-green-400" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
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
                <a href="/categories/{{$item->id}}" class="btn btn-info btn-sm">Detail</a>
                <a href="/categories/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
           </td>
        </tr>
    @empty
        
    @endforelse
    
  </tbody>
</table>
@endsection