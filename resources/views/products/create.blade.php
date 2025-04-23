@extends('layouts.app')

@section('content')
<h4>Tambah Produk</h4>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    @include('products._form', ['submit' => 'Simpan'])
</form>
@endsection
