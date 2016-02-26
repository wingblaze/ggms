@extends('layouts.master')

@section('title', 'View Resource')

@section('content')
<div class="page-header">
	<h1>Hello</h1>
</div>

<p>My name is {{ $resource->name }}</p>
@stop