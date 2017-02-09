@if($errors->has('email'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('email', 'Email') }}
    @if(isset($email))
    {{ Form::text('email', $email) }}
    @else
    {{ Form::text('email', Input::old('email'), array('placeholder'=>'Email')) }}
    @endif
  @if($errors->has('email'))
  <div class="ui red pointing above ui label">{{ $errors->first('email') }}</div>
  @endif
</div>