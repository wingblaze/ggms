@extends('layouts.master')

@section('title', 'Review account')

@section('content')
<div class="page-header">
	<h1>Review account</h1>
  <p class="help-block">As existing members of this golf club, you are encouraged to participate in the review phase of the application process.
    Please note that your account is recorded as the source of this complaint, feedback, or report. </p>
  <p>
    You may also <a href="{{ action('ComplaintController@index') }}">view all pending accounts</a>.
  </p>
  @include('partials.error', ['title' => 'Account review failed'])
</div>

{!! Form::open(array('action' => 'ComplaintController@store')) !!}
  {!! Form::hidden('account_id', $account->id) !!}
  {!! Form::hidden('user_id', $user->id) !!}
  <div class="form-group">
    <label for="group">Membership application requested by</label>
    @if ($account->owner())
      <p>{{ $account->owner()->display_name or 'Name was not specified' }}</p>
    @else
      <p>Name was not specified</p>
    @endif
  </div>
  <div class="form-group">
    <label for="type">Account review</label>
    <p class="help-block">Did you have any problems with this person? Please let us know.</p>
    <br>
    
    <textarea type="text" class="form-control" id="content" name="content" placeholder="" rows="4"></textarea>
    <br><span><em>This account review is written by {{ $user->display_name }}</em></span>
  </div>
  <hr>
  <button type="submit" class="btn btn-primary">Send account review</button>
{{!! Form::close() !!}}
@stop