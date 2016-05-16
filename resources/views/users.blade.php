@extends('layouts.master')

@section('title', 'User List')

@section('content')
<div class="page-header">
	<h1>
		Members
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('UserController@create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					&nbsp New
				</a>
			</div>
		@endif
	</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-4">Name of member</th>
			<th class="col-md-4">Membership holder</th>
		</tr>
		@foreach($users as $user)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('UserController@show', ['id' => $user->id]) }}">
					{{ $user->display_name }}
				</a>
			</td>
			<td class="col-md-4">
				@if ($user->account == FALSE)
					No access
				@elseif ($user->account_type != 'owner')
					@if ($user->account->owner())
					<a href="{{ action('UserController@show', ['id' => $user->account->owner()->id]) }}">
						<?PHP echo $user->account->owner()->display_name ?>
					</a>
					@else
						No owner
					@endif
				@else
					Myself
				@endif
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop