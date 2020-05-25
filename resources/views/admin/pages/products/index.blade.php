@extends('admin.layouts.app')
@section('title', 'produtos')

@section('content')
    <h1>Exibindo os produtos</h1>
    <a href="{{ route('products.create') }}" class= "btn btn-primary">Cadastrar</a>
    <hr>

    <form action="{{ route('products.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Filtrar:" class="formm-control" value="{{ $filters['filter'] ?? '' }}">
        <button type="submit" class="btn btn-info">Pesquisar</button>
    </form>
    <br>

    <table class="table table-striped table-dark">
        <thead>
            <th>Nome</th>
            <th>Preço</th>
            <th width="100">Ações</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                        <a href="{{ route('products.show', $product->id) }}">Detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($filters))
        {!! $products->appends($filters)->links() !!}
    @else
        {!! $products->links() !!}
    @endif

   
@endsection