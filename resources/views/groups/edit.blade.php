@extends('layouts.master')

@section('title', 'View Group')

@section('content')
<div class="page-header">
	<h1>
		Editing group<BR  />
		<small>{{ $group->name }}</small>
		

	</h1>
</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-sm">
			<label>Name</label><BR />
			<input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $group->name }}">
		</div>
		<div class="col-md-8 form-group form-height-sm">
			<label>Description</label><BR />
			<input type="text" class="form-control" id="description" name="description" placeholder="" value="{{ $group->description }}">
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-sm">
			<label>Group category</label><BR />
			<input type="text" class="form-control" id="type" name="type" value="{{ $group->type }}">
		</div>
		<div class="col-md-8 form-group form-height-sm">
			<label>Address</label><BR />
			<input type="text" class="form-control" id="address" name="address" placeholder="" value="{{ $group->address }}">
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-sm">
			<label>Phone</label><BR />
			<input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{ $group->phone }}">
		</div>
		<div class="col-md-4 form-group form-height-sm">
			<label>Fax</label><BR />
			<input type="text" class="form-control" id="fax" name="fax" placeholder="" value="{{ $group->fax }}">
		</div>
	</div>
<hr>
@stop