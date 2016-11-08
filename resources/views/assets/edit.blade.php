@extends('layouts.master')

@section('title', 'Editing Asset')

@section('content')
<div class="page-header">
	<h1>Editing a Asset</h1>
	@include('partials.error', ['title' => 'Asset update failed'])
</div>

{!! Form::model($asset, ['method' => 'PATCH', 'route' => ['assets.update', $asset]]) !!}
<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="name">Asset Name</label>
		<input type="text" class="form-control" id="name" name="name" value="{{ $asset->name }}">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description" value="{{ $asset->description }}">
		<span id="helpBlock" class="help-block">A short description of where this asset can be found.</span>
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="value">Asset Value</label>
		<input type="text" class="form-control" id="value" name="value" value="{{ $asset->value }}">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Update asset</button>
{!! Form::close() !!}
@stop