@extends('layouts.master')

@section('title', 'User Profile')

@section('content')
<div class="page-header">
	<h1>Now editing</h1>
</div>

<p>My name is {{ $target_user->display_name }}</p>
@stop