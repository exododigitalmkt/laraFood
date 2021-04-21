@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('products.index') }}">Produtos</a></li>
    </ol>
    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.search') }}" class="form form-inline" method="POST">
                @csrf
                <input class="form-control" type="text" name="filter" placeholder="Pesquisar..." value="{{ $filters['filter'] ?? '' }}">
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th style="width: 300px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" width="90px">
                        </td>
                        <td>
                            {{ $product->title }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">EDITAR</a>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">VER</a>
                            <a href="{{ route('products.categories', $product->id) }}" class="btn btn-dark"><i class="fas fa-layer-group"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop