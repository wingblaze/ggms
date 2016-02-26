@extends('layouts.master')

@section('title', 'Review account')

@section('content')
<div class="page-header">
	<h1>Review account</h1>
  <p>As existing members of this golf club, you are encouraged to participate in the review phase of the application process.
    Please note that your account is recorded as the source of this complaint, feedback, or report. </p>
</div>

{!! Form::open(array('action' => 'ComplaintController@store')) !!}
  {!! Form::hidden('account_id', $account->id) !!}
  {!! Form::hidden('user_id', 1) !!}
  <div class="form-group">
    <label for="group">Membership application requested by</label>
    <p>{{ 'Name was not specified' }}</p>
  </div>
  <div class="form-group">
    <label for="type">Account review</label><br>
    
    <textarea type="text" class="form-control" id="content" name="content" placeholder="" rows="4"></textarea>
    <span><em>Account review by {{ 'name was not specified' }}</em></span>
  </div>
  <hr>
  <button type="submit" class="btn btn-primary">Send account review</button>
</form>
@stop