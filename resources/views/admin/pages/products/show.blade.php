@extends('adminlte::page')

@section('title', "Detalhes do Produto {$product->title}")

@section('content_header')
    <h1>Detalhes do Produto <strong>{{ $product->title }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" width="90px">
            <ul>
                <li>
                    <strong>Title: </strong> {{ $product->title }}
                </li>
                <li>
                    <strong>Flag: </strong> {{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
            </ul>
        </div>

        @include('admin.includes.alerts')

        <div class="card-footer">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Deletar o Produro</button>
            </form>
        </div>
    </div>
@stop