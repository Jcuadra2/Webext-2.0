@if($errors->has('fax'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('fax', 'Fax') }}
    @if(isset($fax))
    {{ Form::text('fax', $fax) }}
    @else
    {{ Form::text('fax', Input::old('fax'), array('placeholder'=>'Fax')) }}
    @endif
  @if($errors->has('fax'))
  <div class="ui red pointing above ui label">{{ $errors->first('fax') }}</div>
  @endif
</div>