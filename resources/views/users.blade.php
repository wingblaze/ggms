@extends('layouts.master')

@section('title', 'User List')

@section('content')
<div class="page-header">
	<h1>Members</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-2">Name of member</th>
			<th class="col-md-2">Membership holder</th>
			<th class="col-md-3">Options</th>
		</tr>
		@foreach($users as $user)
		<tr>
			<td class="col-md-2">
				<a href="{{ action('UserController@show', ['id' => $user->id]) }}">
					{{ $user->name }}
				</a>
			</td>
			<td class="col-md-2">
				@if ($user->account == FALSE)
					No access
				@elseif ($user->account_type != 'owner')
					@if ($user->account->owner())
					<a href="{{ action('UserController@show', ['id' => $user->account->owner()->id]) }}">
						<?PHP echo $user->account->owner()->name ?>
					</a>
					@else
						No owner
					@endif
				@else
					Myself
				@endif
				</td>
				<td class="col-md-3">
					<a class="btn btn-sm btn-default" href="{{action('UserController@edit', ['id' => $user->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('UserController@destroy', ['id' => $user->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop