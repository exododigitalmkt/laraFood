@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" class="form form-inline" method="POST">
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
                        <th>Identificador</th>
                        <th>Descrição</th>
                        <th style="width: 300px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                    <tr>
                        <td>
                            {{ $table->identify }}
                        </td>
                        <td>
                            {{ $table->description }}
                        </td>
                        <td>
                            <a href="{{ route('tables.qrcode', $table->identify) }}" target="_blank" class="btn btn-default"><i class="fas fa-qrcode"></i></a>
                            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">EDITAR</a>
                            <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">VER</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif
        </div>
    </div>
@stop