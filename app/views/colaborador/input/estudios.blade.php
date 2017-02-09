@if($errors->has('estudios'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('estudio_id', 'Estudios') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('estudio_id', Input::old('estudio_id')) }}
    <div class="menu">
      @foreach($estudios as $estudio)
      <div class="item" data-value="{{ $estudio->id }}">{{ $estudio->estudio }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('estudios'))
  <div class="ui red pointing above ui label">{{ $errors->first('estudios') }}</div>
  @endif
</div>
