@extends('layouts.master')

@section('title', 'User List')

@section('content')
<div class="page-header">
	@if(isset($inactive) && $inactive)
		<h1>Inactive Accounts</h1>
	@else
		<h1>Membership Accounts</h1>
	@endif

</div>
@if($user->hasRole('membership_manager'))
<div class="container">
	<p>As a membership manager, you can <a href="{{ action('ComplaintController@index') }}">view the list of pending accounts</a> to accept or deny applications for membership.</p>
</div>
@elseif($user->hasRole('marketing_manager'))
<div class="container">
	<p>As a marketing manager, you can <a href="{{ action('AccountController@inactives') }}">view the list of inactive accounts</a> to follow up payment from account owners.</p>
</div>
@endif
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-2">Membership holder</th>
			<th class="col-md-2">Status</th>
			<th class="col-md-2">Membership type</th>
			<th class="col-md-3">Options</th>
		</tr>
		@foreach($accounts as $account)
		<tr>
			<td class="col-md-2">
				@if ($account->owner())
					{{ $account->owner()->name }}
				@else
					No owner
				@endif
			</td>
			<td class="col-md-2">
				{{ $account->status }}
			</td>
			<td class="col-md-2">
				@if (null !== $account->current_membership_slot())
					<?php print_r($account->current_membership_slot()['type']); ?>
				@else
					No membership yet
				@endif
			</td>
			<td class="col-md-3">
				<div class="btn-group" role="group" aria-label="Options">
					<a class="btn btn-sm btn-default" href="{{action('AccountController@show', ['id' => $account->id])}}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp Account</a>
					@if ($account->owner())
						<a class="btn btn-sm btn-default" href="{{action('UserController@show', ['id' => $account->owner()->id])}}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp Owner</a>
					@endif
					
				</div>
				
				@if ($user && $user->hasRole('membership_manager'))
				&nbsp
				<a class="btn btn-sm btn-danger" href="{{action('AccountController@destroy', ['id' => $account->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Disable</a>
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>


@stop