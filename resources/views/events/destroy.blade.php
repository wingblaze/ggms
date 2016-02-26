@extends('layouts.master')

@section('title', 'View Event')

@section('content')
<div class="page-header">
	<h1>View Event details</h1>
</div>

<p>Event name is {{ $event->name }}</p>
@stop