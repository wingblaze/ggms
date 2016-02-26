@extends('layouts.master')

@section('title', 'Edit Event')

@section('content')
<div class="page-header">
	<h1>Now editing an event</h1>
</div>

<p>name: {{ $event->name }}</p>
@stop