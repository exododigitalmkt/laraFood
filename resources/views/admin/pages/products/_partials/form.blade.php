@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="title">Title</label>
    <input id="title" class="form-control" type="text" name="title" value="{{ $product->title ?? old('title') }}">
</div>
<div class="form-group">
    <label for="price">Preço</label>
    <input id="price" class="form-control" type="text" name="price" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="image">Imagem</label>
    <input id="image" class="form-control" type="file" name="image">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ $product->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>