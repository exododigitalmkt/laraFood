@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tenants.search') }}" class="form form-inline" method="POST">
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
                        <th>Nome</th>
                        <th style="width: 300px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                    <tr>
                        <td>
                            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->title }}" width="90px">
                        </td>
                        <td>
                            {{ $tenant->name }}
                        </td>
                        <td>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">EDITAR</a>
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">VER</a>
                            {{-- <a href="{{ route('tenants.plans', $tenant->id) }}" class="btn btn-dark"><i class="fas fa-layer-group"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif
        </div>
    </div>
@stop