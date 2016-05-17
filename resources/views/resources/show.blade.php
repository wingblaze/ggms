@extends('layouts.master')

@section('title', 'View Resource')

@section('content')
<div class="page-header">
	<h1>
		View facility <small>{{ $resource->name }}</small>
		<div class="pull-right">
			<a class="btn btn-default" href="{{action('ResourceController@edit', $resource->id)}}">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				&nbsp Edit
			</a>
			<a class="btn btn-danger" href="{{action('ResourceController@destroy', $resource->id)}}">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				&nbsp Disable
			</a>
		</div>
	</h1>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-xs">
		<label>Type</label><BR />
		{{ $resource->type }}
	</div>
	<div class="col-md-8 form-group form-height-xs">
		<label>Description</label><BR />
		{{ $resource->description }}		
	</div>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-xs">
		<label>Date created (facility)</label><BR />
		{!! display_readable_date($resource->created_at) !!}
	</div>
	<div class="col-md-4 form-group form-height-xs">
		<label>Date last updated (facility information)</label><BR />
		{!! display_readable_date($resource->updated_at) !!}
	</div>
</div>
@stop