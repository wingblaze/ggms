@extends('layouts.master')

@section('title', 'Edit Resource')

@section('content')
<div class="page-header">
	<h1>Now editing</h1>
</div>

<p>Resource name is {{ $resource->name }}</p>
@stop