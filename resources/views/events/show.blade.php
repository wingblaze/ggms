@extends('layouts.master')

@section('title', 'View Event')

@section('content')
<div class="page-header">

	<?php $notes = json_decode($event->notes) ?>
	<h1>View event <small>{{ $event->name }}</small></h1>
	<p class="help-block"><label>Description:</label> {{ $event->description }}</p>
	@if ($notes->requested_by)
		<?php $user = App\User::find($notes->requested_by); ?>
		<p class="help-block"><label>Requested by:</label> {{  $user->display_name }}</p>
	@endif
</div>
<p><label>start_date</label><BR />
	{{ $event->start_date }}
</p>
<hr>
<p><label>end_date</label><BR />
	{{ $event->end_date }}
</p>
<hr>
<p><label>expected_attendees</label><BR />
	{{ $event->expected_attendees }}
</p>
<hr>
<p><label>actual_attendees</label><BR />
	{{ $event->actual_attendees }}
</p>
<hr>
@if ($event->resource)
<p><label>facility</label><BR />
	<a href="{{ action('ResourceController@show', $event->resource->id) }}">{{ $event->resource->name }}</a>
</p>
<hr>
@endif
<p><label>created_at</label><BR />
	{{ $event->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $event->updated_at }}
</p>
<hr>


<h3>Preparation details</h3>
<p class="help-block">As marketing manager, these are the information that will aid you in the successful preparation of the requested event.</p>

@foreach ($notes->preparations as $key => $value)
<p>
	<label>
		{{ prettify_text($key) }}
	</label> <BR />
	{{ ($value != 'on') ? $value : 'Requires preparation' }}
</p>
@endforeach

@stop