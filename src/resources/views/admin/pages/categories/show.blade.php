@extends('adminlte::page')

@section('title', "Detalhes da Categoria {$category->name}")

@section('content_header')
    <h1>Detalhes da Categoria <strong>{{ $category->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
            </ul>
        </div>

        @include('admin.includes.alerts')

        <div class="card-footer">
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Deletar a Categoria</button>
            </form>
        </div>
    </div>
@stop