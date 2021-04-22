@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input id="name" class="form-control" type="text" name="name" value="{{ $role->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <input id="description" class="form-control" type="text" name="description" value="{{ $role->description ?? old('description') }}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>