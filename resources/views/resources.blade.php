@extends('layouts.master')

@section('title', 'Facilities List')

@section('content')
<div class="page-header">
	<h1>
		Facilities
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('ResourceController@create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					&nbsp New
				</a>
			</div>
		@endif
		<div class="pull-right">
			<a class="btn btn-default" href="{{action('ResourceController@rent')}}">
				<span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
				&nbsp Rent a facility
			</a>
		</div>
	</h1>
</div>
<div class="content">
	<h2>View facilities</h2>
	<p class="help-block">These are the list of facilities that can be rented by members of the golf community.</p>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th class="col-md-12">Name of Facility</th>
			</tr>
			@foreach($resources as $resource)
			<tr>
				<td class="col-md-12">
					<a href="{{action('ResourceController@show', ['id' => $resource->id])}}">
						{{ $resource->name }}
					</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
<hr>
<div class="content">
	<h2>Rentals today</h2>
	@if (count($listings) == 0)
		<p>There are no facilities being rented today.</p>
	@else
	<p class="help-block">These are the facilities being rented today.</p>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th class="col-md-3">Name of Facility and Renter</th>
				<th class="col-md-1">Status</th>
				<th class="col-md-1">Rental start time</th>
				<th class="col-md-1">Rental end time</th>
			</tr>
			
			@foreach($listings as $listing)
			<tr>
				<td class="col-md-3">
					<a href="{{action('ResourceController@show', ['id' => $listing->resource->id])}}">
						{{ $listing->resource->name}}
					</a>
					 by
					 <a href="{{action('UserController@show', ['id' => $listing->user->id])}}">
					 	{{ $listing->user->display_name }}
					</a>
				</td>
				<td class="col-md-1">{{ $listing->status }}</td>
				<td class="col-md-1">{{ Carbon\Carbon::parse($listing->start_time)->format('h:i A') }}</td>
				<td class="col-md-1">
					{{ Carbon\Carbon::parse($listing->end_time)->format('h:i A') }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@endif
</div>
@stop