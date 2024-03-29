@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>
    <h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('permissions.search') }}" class="form form-inline" method="POST">
                @csrf
                <input class="form-control" type="text" name="filter" placeholder="Pesquisar..." value="{{ $filters['filter'] ?? '' }}">
                <button class="btn btn-dark" type="submit">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 250px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            {{ $permission->name }}
                        </td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">EDITAR</a>
                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">VER</a>
                            <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-dark"><i class="fas fa-address-book"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop