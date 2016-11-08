@extends('layouts.master')

@section('title', 'Editing Terminal')

@section('content')
<div class="page-header">
	<h1>Editing a Terminal</h1>
	@include('partials.error', ['title' => 'Terminal update failed'])
</div>

{!! Form::model($terminal, ['method' => 'PATCH', 'route' => ['terminals.update', $terminal]]) !!}
<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="title">Terminal Name</label>
		<input type="text" class="form-control" id="title" name="title" value="{{ $terminal->title }}">
	</div>
	<div class="form-group form-height-md col-md-8">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description" value="{{ $terminal->description }}">
		<span id="helpBlock" class="help-block">A short description of where this terminal can be found.</span>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="longitude">Longitude</label>
		<input type="number" class="form-control" id="longitude" name="longitude" value="{{ $terminal->longitude }}">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="latitude">Latitude</label>
		<input type="number" class="form-control" id="latitude" name="latitude" value="{{ $terminal->latitude }}">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Update terminal</button>
{!! Form::close() !!}
@stop