@extends('layouts.master')

@section('title', 'Create Asset')

@section('content')
<div class="page-header">
	<h1>Create a new Asset</h1>
	<p>This process allows you to add a new asset of the golf course.</p>
	@include('partials.error', ['title' => 'Asset creation failed'])
</div>

{!! Form::open(array('action' => 'AssetController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="name">Asset Name</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>
	<div class="form-group form-height-md col-md-8">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description">
		<span id="helpBlock" class="help-block">A short description of this asset.</span>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-12">
		<label for="value">Value</label>
		<input type="number" class="form-control" id="value" name="value">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Create asset</button>
</form>
@stop