@extends('adminlte::page')

@section('title', "Perfis do Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a class="active" href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
    </ol>
    <h1>Perfis do Plano <strong>{{ $plan->name }}</strong>
        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark">ADD NOVO PERFIL</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile->name }}
                        </td>
                        <td>
                            <a href="{{ route('plans.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop