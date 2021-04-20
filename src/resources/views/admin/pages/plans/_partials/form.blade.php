@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input id="name" class="form-control" type="text" name="name" value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="price">Preço</label>
    <input id="price" class="form-control" type="text" name="price" value="{{ $plan->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <input id="description" class="form-control" type="text" name="description" value="{{ $plan->description ?? old('description') }}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>