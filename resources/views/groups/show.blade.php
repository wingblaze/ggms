@extends('layouts.master')

@section('title', 'View Group')

@section('content')
<div class="page-header">
	<h1>
		View group<BR />
		<small>{{ $group->name }}</small>
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('GroupController@edit', $group->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('GroupController@destroy', $group->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>
</div>
	<div class="row">
		<div class="col-md-12 form-group form-height-xs">
			<label>Description</label><BR />
			{{ $group->description }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Group category</label><BR />
			{{ $group->type }}
		</div>
		<div class="col-md-8 form-group form-height-xs">
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
			<label>Date of creation (group)</label><BR />
			{!! display_precise_date($group->created_at) !!}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Date last updated (group information)</label><BR />
			{!! display_precise_date($group->updated_at) !!}
		</div>
	</div>
@stop