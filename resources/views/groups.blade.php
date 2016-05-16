@extends('layouts.master')

@section('title', 'Group List')

@section('content')
<div class="page-header">
	<h1>
		Groups
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('GroupController@create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					&nbsp New
				</a>
			</div>
		@endif
		
	</h1>
</div>
<?php $i = 0; ?>
@foreach ($categories as $category)
<?php $i = $i %= 3; if ($i == 0): ?>
<div class="row">
<?php endif; ?>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">{{ ucwords($category->type) }}</div>
		<div class="panel-body">
			<?PHP $groups = $category->groups; ?>

			@foreach($groups as $group)
			<div class="group">
				<a href="{{ action('GroupController@show', ['id' => $group->id]) }}">
					{{ $group->name }}
				</a>
				<!--
				<a class="btn btn-sm btn-default" href="{{action('GroupController@edit', ['id' => $group->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
				&nbsp
				<a class="btn btn-sm btn-danger" href="{{action('GroupController@destroy', ['id' => $group->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
			-->
			</div>
			@endforeach

		</div>
	</div>
</div>
<?php if ($i == 0): ?>
</div>
<?php endif; $i++; ?>
@endforeach

@stop