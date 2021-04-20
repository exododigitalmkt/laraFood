@extends('adminlte::page')

@section('title', "Detalhes do Pefil {$profile->name}")

@section('content_header')
    <h1>Detalhes do Pefil <strong>{{ $profile->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>
        </div>

        @include('admin.includes.alerts')

        <div class="card-footer">
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Deletar o Pefil</button>
            </form>
        </div>
    </div>
@stop