@if($errors->has('cif_nif'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('cif_nif', 'DNI/NIF') }}
  <div class="ui labeled input">
    {{ Form::text('cif_nif', Input::old('cif_nif'), array('placeholder'=>'CIF NIF')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('cif_nif'))
  <div class="ui red pointing above ui label">{{ $errors->first('cif_nif') }}</div>
  @endif
</div>