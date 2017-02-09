@if($errors->has('diploma'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('diploma', 'Diploma') }}
  <div class="ui left labeled icon input">
    @if(isset($diploma))
    {{ Form::text('diploma', $diploma) }}
    @else
    {{ Form::text('diploma', Input::old('diploma'), array('placeholder'=>'Año de entrega')) }}
    @endif
    <i class="text file icon"></i>
  </div>
  @if($errors->has('diploma'))
  <div class="ui red pointing above ui label">{{ $errors->first('diploma') }}</div>
  @endif
</div>