@if($errors->has('categoria_id'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('categoria_id', 'Categoría') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('categoria_id', Input::old('categoria_id')) }}
    <div class="menu">
      @foreach($categorias as $categoria)
      <div class="item" data-value="{{ $categoria->id }}">{{ $categoria->categoria }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('categoria_id'))
  <div class="ui red pointing above ui label">{{ $errors->first('categoria_id') }}</div>
  @endif
</div>