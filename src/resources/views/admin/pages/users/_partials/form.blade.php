@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input id="name" class="form-control" type="text" name="name" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input id="email" class="form-control" type="email" name="email" value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label for="description">Senha</label>
    <input id="password" class="form-control" type="password" name="password">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>