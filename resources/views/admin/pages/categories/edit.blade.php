@extends('adminlte::page')

@section('title', "Editar Categoria {$category->name}")

@section('content_header')
    <h1>Editar Categoria <strong>{{ $category->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.categories._partials.form')      
            </form>
        </div>
    </div>
@stop