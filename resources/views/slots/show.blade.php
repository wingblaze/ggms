@extends('layouts.master')

@section('title', 'Membership Slot')

@section('content')
<div class="page-header">
	<h1>Hello</h1>
</div>

<p>The name of this slot is {{ $slot->type }} with description {{ $slot->description }}</p>
@stop