@extends('adminlte::page')

@section('title', "Permissões do Perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Permissões do Perfil <strong>{{ $profile->name }}</strong>
        <a href="{{ route('profiles.create') }}" class="btn btn-dark">ADD NOVA PERMISSÃO</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.search') }}" class="form form-inline" method="POST">
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
                            <a href="{{ route('profiles.edit', $permission->id) }}" class="btn btn-info">EDITAR</a>
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