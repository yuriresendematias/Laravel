@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>    

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="form"> {{--enctype="multipart/form-data" é usado para trabalhar com upload de arquivos  --}}
        {{-- <input type="text" name="_token" value="{{csrf_token()}}"> --}}
        @include('admin.pages.products._partials.form')
    </form>
@endsection