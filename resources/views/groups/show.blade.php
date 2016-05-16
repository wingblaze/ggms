@extends('layouts.master')

@section('title', 'View Group')

@section('content')
<div class="page-header">
	<h1>View group <small>{{ $group->name }}</small></h1>
</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Description</label><BR />
			{{ $group->description }}
		</div>
		<div class="col-md-8 form-group form-height-xs">
			<label>Group category</label><BR />
			{{ $group->type }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group form-height-xs">
			<label>Address</label><BR />
			{{ $group->address }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Phone</label><BR />
			{{ $group->phone }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Fax</label><BR />
			{{ $group->fax }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Date of group creation</label><BR />
			{!! display_precise_date($group->created_at) !!}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Date of last update of group information</label><BR />
			{!! display_precise_date($group->updated_at) !!}
		</div>
	</div>
<hr>
@stop