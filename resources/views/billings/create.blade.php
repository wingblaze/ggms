@extends('layouts.master')

@section('title', 'Create Billing')


@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Create a new Billing</h1>
	<p>This process allows you to add a new billing for a user. A billing is a group of purchases.</p>
	@include('partials.error', ['title' => 'Billing creation failed'])
</div>

{!! Form::open(array('action' => 'BillingController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="user_id">Billing for user</label>
		<input type="text" class="form-control" id="user_id" name="user_id">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="title">Title of billing</label>
		<input type="text" class="form-control" id="title" name="title">
		<p class="help-block">This is used as a remarks of this billing (i.e. Nov 2 vacation).</p>
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="terminal_id">Terminal ID</label>
		<input type="text" class="form-control" id="terminal_id" name="terminal_id">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Create billing</button>
{!! Form::close() !!}

<script type="text/javascript">
  $.get('/users.json', function(data){
    $("#user_id").typeahead({ source:data });
  },'json');
  $.get('/terminals.json', function(data){
    $("#terminal_id").typeahead({ source:data });
  },'json');
</script>

@stop