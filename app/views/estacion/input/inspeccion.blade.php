<div class="field" id="inspecciones">

  <div class="inspeccion ui message">
    @if($errors->has('fecha_inspeccion[]'))
    <div class="error date field">
    @else
    <div class="date field">
    @endif
      {{ Form::label('fecha_inspeccion[]', 'Fecha de Inspección') }}
      <input name="fecha_inspeccion[]" type="text" placeholder="dd/mm/aaaa">
      @if($errors->has('fecha_inspeccion[]'))
      <div class="ui red pointing above ui label">{{ $errors->first('fecha_inspeccion[]') }}</div>
      @endif
    </div>

    @if($errors->has('inspeccion[]'))
    <div class="error field">
    @else
    <div class="field">
    @endif
      {{ Form::label('inspeccion[]', 'Observaciones') }}
      <div class="ui left labeled icon input">
      @if(isset($inspeccion))
        {{ Form::textarea('inspeccion[]', $inspeccion) }}
      @else
        <textarea name="inspeccion[]" placeholder="Escribe aquí las observaciones de la inspección"></textarea>
      @endif
      </div>
      @if($errors->has('inspeccion[]'))
      <div class="ui red pointing above ui label">{{ $errors->first('inspeccion[]') }}</div>
      @endif
    </div>

    <div class="ui tiny red button" id="removeInspeccion">
      Eliminar
    </div>

  </div>

</div>

<div class="mini labeled icon ui button" id="addInspeccion">
  <i class="add green icon"></i>Crear
</div>

