@extends('layouts.master')

@section('title', 'Create Terminal')

@section('content')
<div class="page-header">
	<h1>Create a new Terminal</h1>
	<p>This process allows you to add a new terminal, where an employee can handle a member.</p>
	@include('partials.error', ['title' => 'Terminal creation failed'])
</div>

{!! Form::open(array('action' => 'TerminalController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="title">Terminal Name</label>
		<input type="text" class="form-control" id="title" name="title">
	</div>
	<div class="form-group form-height-md col-md-8">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description">
		<span id="helpBlock" class="help-block">A short description of where this terminal can be found.</span>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="longitude">Longitude</label>
		<input type="number" class="form-control" id="longitude" name="longitude">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="latitude">Latitude</label>
		<input type="number" class="form-control" id="latitude" name="latitude">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Create terminal</button>
</form>
@stop