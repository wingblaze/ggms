@extends('layouts.master')

@section('title', 'Group List')

@section('content')
<div class="page-header">
	<h1>Groups</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-2">Name of member</th>
			<th class="col-md-4">Description</th>
			<th class="col-md-3">Options</th>
		</tr>
		@foreach($groups as $group)
		<tr>
			<td class="col-md-2">
				<a href="{{ action('GroupController@show', ['id' => $group->id]) }}">
					{{ $group->name }}
				</a>
			</td>
			<td class="col-md-4">
				<?PHP echo $group->description ?>
			</td>
				<td class="col-md-3">
					<a class="btn btn-sm btn-default" href="{{action('GroupController@edit', ['id' => $group->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('GroupController@destroy', ['id' => $group->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop