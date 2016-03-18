@extends('layouts.master')

@section('title', 'Group List')

@section('content')
<div class="page-header">
	<h1>Groups</h1>
</div>
@foreach ($categories as $category)
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
@endforeach
@stop