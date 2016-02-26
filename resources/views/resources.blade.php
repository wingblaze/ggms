@extends('layouts.master')

@section('title', 'Facilities List')

@section('content')
<div class="page-header">
	<h1>Facilities</h1>
</div>
<div class="content">
	<h2>View facilities</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th class="col-md-8">Name of Facility</th>
				<th class="col-md-2">Date created</th>
				<th class="col-md-4">Options</th>
			</tr>
			@foreach($resources as $resource)
			<tr>
				<td class="col-md-8">
					<a href="{{action('ResourceController@show', ['id' => $resource->id])}}">
						{{ $resource->name }}
					</a>
				</td>
				<td class="col-md-2">{{ $resource->created_at }}</td>
				<td class="col-md-4">
					<a class="btn btn-sm btn-default" href="{{action('ResourceController@edit', ['id' => $resource->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('ResourceController@destroy', ['id' => $resource->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
<div class="content">
	<h2>Current facilities being rented</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th class="col-md-3">Name of Facility and Renter</th>
				<th class="col-md-1">Rental start date and time</th>
				<th class="col-md-1">Rental end date and time</th>
				<th class="col-md-1">Status</th>
				<th class="col-md-4">Options</th>
			</tr>
			@foreach($listings as $listing)
			<tr>
				<td class="col-md-3">
					<a href="{{action('ResourceController@show', ['id' => $listing->resource->id])}}">
						{{ $listing->resource->name}}
					</a>
					 by
					 <a href="{{action('UserController@show', ['id' => $listing->user->id])}}">
					 	{{ $listing->user->name }}
					</a>
				</td>
				<td class="col-md-3">{{ $listing->start_time }}</td>
				<td class="col-md-3">{{ $listing->end_time }}</td>
				<td class="col-md-1">{{ $listing->status }}</td>
				<td class="col-md-4">
					<a class="btn btn-sm btn-default" href="{{action('ResourceController@edit', ['id' => $listing->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@stop