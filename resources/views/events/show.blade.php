@extends('layouts.master')

@section('title', 'View Event')

@section('content')
<div class="page-header">

	<?php $notes = json_decode($event->notes) ?>
	<h1>
		View event <BR />
		<small>{{ $event->name }}</small>
		@if ($user->hasRole('marketing_manager'))
		<div class="pull-right">
			<a class="btn btn-default" href="{{action('EventController@edit', $event->id)}}">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				&nbsp Edit
			</a>
			<a class="btn btn-danger" href="{{action('EventController@destroy', $event->id)}}">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				&nbsp Disable
			</a>
		</div>
	@endif
	</h1>
	<p class="help-block">{{ $event->description }}</p>
	@if ($notes && $notes->requested_by)
		<?php $user = App\User::find($notes->requested_by); ?>
		<p class="help-block"><label>Requested by:</label> {{  $user->display_name }}</p>
	@endif
	
</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">

			<label>Start date</label><BR />
			{{ $event->start_date }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>End date</label><BR />
			{{ $event->end_date }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Expected attendees</label><BR />
			{{ $event->expected_attendees }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Actual attendees</label><BR />
			{{ $event->actual_attendees }}
		</div>
	</div>

@if ($event->resource)
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>facility</label><BR />
			<a href="{{ action('ResourceController@show', $event->resource->id) }}">{{ $event->resource->name }}</a>
		</div>
	</div>
@endif
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Date created (events)</label><BR />
			{{ $event->created_at }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Date last updated (event information)</label><BR />
			{{ $event->updated_at }}
		</div>
	</div>

@if ($notes)
<h3>Preparation details</h3>
<p class="help-block">As marketing manager, these are the information that will aid you in the successful preparation of the requested event.</p>

@foreach ($notes->preparations as $key => $value)
<div class="row">
	<div class="col-md-4 form-group form-height-xs">

	<label>
		{{ prettify_text($key) }}
	</label> <BR />
	{{ ($value != 'on') ? $value : 'Requires preparation' }}
	</div>
</div>
@endforeach
@endif

@stop