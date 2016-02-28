@extends('layouts.master')

@section('title', 'User Profile')

@section('content')
<div class="page-header">
	<h1>Hello</h1>
</div>

<p>My name is {{ $target_user->name }}</p>
@stop