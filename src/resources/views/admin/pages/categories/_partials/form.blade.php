@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input id="name" class="form-control" type="text" name="name" value="{{ $category->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ $category->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>