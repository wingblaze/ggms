@extends('layouts.master')

@section('title', 'Event List')

@section('content')
<div class="page-header">
	<h1>
		Event list
		@if ($user->hasRole('marketing_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('EventController@create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					&nbsp New
				</a>
			</div>
		@endif
	</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-3">Name of event</th>
			<th class="col-md-5">Description</th>
			<th class="col-md-2">Date of event</th>
			<th class="col-md-2">Date creation (event)</th>
		</tr>
		@foreach($events as $event)
		<tr>
			<td class="col-md-3">
				<a href="{{action('EventController@show', ['id' => $event->id])}}">
					{{ $event->name }}
				</a>
			</td>
			<td class="col-md-5">{{ $event->description }}</td>
			<td class="col-md-2">{!! display_readable_date($event->start_date) !!}</td>
			<td class="col-md-2">{!! display_readable_date($event->created_at) !!}</td>
		</tr>
		@endforeach
	</table>
</div>
@stop