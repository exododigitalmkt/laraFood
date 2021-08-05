@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="identify">Identificador</label>
    <input id="identify" class="form-control" type="text" name="identify" value="{{ $table->identify ?? old('identify') }}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ $table->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>