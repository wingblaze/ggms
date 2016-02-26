@extends('layouts.master')

@section('title', 'View Group')

@section('content')
<div class="page-header">
	<h1>View Group details</h1>
</div>

<p>Group name is {{ $group->name }}</p>
@stop