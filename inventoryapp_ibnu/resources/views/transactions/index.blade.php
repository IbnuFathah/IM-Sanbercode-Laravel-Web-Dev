@extends('layouts.master')
@section('title')
    Tampil Categories
@endsection

@section('content')
    <a href="transactions/create" class="btn btn-primary btn-sm my-3">Input Transactions</a>

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-800 dark:text-green-400" role="alert">
          {{ session('success') }}
        </div>
    @endif
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Produk</th>
      <th scope="col">Type (in,out)</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($transactions as $item)
        <tr>
           <th scope="row">{{$loop->iteration}}</th>
           <td>{{$item->user->name}}</td>
           <td>{{$item->product->name}}</td>
           <td>
            @if ($item->type === "in")
                <span class="badge text-bg-primary">{{$item->type}}</span>
            @else
                <span class="badge text-bg-danger">{{$item->type}}</span>
            @endif
            
           </td>
           <td>{{$item->amount}}</td>
        </tr>
    @empty
        <tr>
          <td>Transaksi Masih Kosong</td>
        </tr>
    @endforelse
    
  </tbody>
</table>
@endsection