@extends('adminlte::page')

@section('title', "Detalhes da Mesa {$table->identify}")

@section('content_header')
    <h1>Detalhes da Mesa <strong>{{ $table->identify }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Identificador: </strong> {{ $table->identify }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $table->description }}
                </li>
            </ul>
        </div>

        @include('admin.includes.alerts')

        <div class="card-footer">
            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Deletar a Mesa</button>
            </form>
        </div>
    </div>
@stop