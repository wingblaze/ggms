@extends('layouts.master')

@section('title', 'View Event')

@section('content')
<div class="page-header">
	<h1>View event <small>{{ $event->name }}</small></h1>
</div>
<p><label>Description</label><BR />
	{{ $event->description }}
</p>
<hr>
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
<p><label>created_at</label><BR />
	{{ $event->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $event->updated_at }}
</p>
<hr>
@stop