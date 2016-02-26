@extends('layouts.master')

@section('title', 'Event List')

@section('content')
<div class="page-header">
	<h1>Event list</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-2">Name of event</th>
			<th class="col-md-3">Description</th>
			<th class="col-md-2">Date of event</th>
			<th class="col-md-2">Date created</th>
			<th class="col-md-2">Options</th>
		</tr>
		@foreach($events as $event)
		<tr>
			<td class="col-md-2">
				<a href="{{action('EventController@show', ['id' => $event->id])}}">
					{{ $event->name }}
				</a>
			</td>
			<td class="col-md-3">{{ $event->description }}</td>
			<td class="col-md-2">{{ $event->start_date }}</td>
			<td class="col-md-2">{{ $event->created_at }}</td>
			<td class="col-md-2">
				<a class="btn btn-sm btn-default" href="{{action('EventController@edit', ['id' => $event->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
				&nbsp
				<a class="btn btn-sm btn-danger" href="{{action('EventController@destroy', ['id' => $event->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
			</td>
		</tr>
		@endforeach
	</table>
</div>
@stop