@extends('adminlte::page')

@section('title', "Categorias Disponíveis Produto {$product->title}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('products.categories.available', $product->id) }}">Disponíveis</a></li>
    </ol>
    <h1>Categorias Disponíveis Produto <strong>{{ $product->title }}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.categories.available', $product->id) }}" class="form form-inline" method="POST">
                @csrf
                <input class="form-control" type="text" name="filter" placeholder="Pesquisar..." value="{{ $filters['filter'] ?? '' }}">
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('products.categories.attach', $product->id) }}" method="POST">
                        @csrf

                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')

                                <button class="btn btn-success" type="submit">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop