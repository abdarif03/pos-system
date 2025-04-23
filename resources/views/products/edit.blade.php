@extends('layouts.app')

@section('content')
<h4>Edit Produk</h4>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    @include('products._form', ['submit' => 'Update'])
</form>
@endsection
