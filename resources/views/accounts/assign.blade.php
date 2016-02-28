@extends('layouts.master')

@section('title', 'Assign User')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Assign User to an Account</h1>
</div>

{!! Form::open(array('action' => 'AccountController@assign_user')) !!}
  <div class="form-group">
    <label for="user_name">Name of User</label>
    <input type="text" class="form-control" id="user_name" name="user" placeholder="Name of User" data-provide="typeahead" autocomplete="off" required>
  </div> 
  <div class="form-group">
    <div class="checkbox">
      <label><input type="checkbox" name="owner">Owner</label>
    </div>
  </div>

  <input type="hidden" name="id" value="{{ $account_id }}"/>

  <button type="submit" class="btn btn-primary">Assign User</button>
{!! Form::close() !!}

<script type="text/javascript">
  $.get('/users.json', function(data){
    $("#user_name").typeahead({ source:data });
  },'json');
</script>
@stop