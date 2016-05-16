@extends('layouts.master')

@section('title', 'Pending Accounts')

@section('content')
<div class="page-header">
	<h1>Pending accounts</h1>
	<p class="help-block">As existing members of this golf club, you are encouraged to participate in the review phase of the application process.
    Please let us know if there are any complaints on new membership applications.</p>
</div>
@if (count($accounts) == 0)
<p>There are currently no pending accounts.</p>
@else
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-6">Membership holder</th>
			<th class="col-md-2 hidden-xs">Complaints</th>
			<th class="col-md-4">Options</th>
		</tr>
		@foreach($accounts as $account)
		<tr>
			<td class="col-md-6">
				@if ($account->owner())
				<a href="{{action('AccountController@show', ['id' => $account->id])}}">
					{{ $account->owner()->display_name }}
				</a>
				@else
					No owner
				@endif
			</td>
			<td class="col-md-2 hidden-xs">
				{{ App\Complaint::where('account_id', '=', $account->id)->count() }}
			</td>
			<td class="col-md-4">
				<div class="btn-group" role="group" aria-label="Options">
					<a class="btn btn-sm btn-default" href="{{action('AccountController@show', ['id' => $account->id])}}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp Account</a>
					@if ($account->owner())
						<a class="btn btn-sm btn-default" href="{{action('UserController@show', ['id' => $account->owner()->id])}}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp Owner</a>
					@endif
					@if ($user->hasRole('user') && $user->is_owner())
					<a class="btn btn-sm btn-default" href="{{url('review', ['id' => $account->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Review</a>
					@endif
				
				</div>
				@if ($user && $user->hasRole('membership_manager'))
				<div class="btn-group" role="group" aria-label="Options">
					&nbsp
					<a class="btn btn-sm btn-primary" href="{{action('AccountController@accept', ['id' => $account->id])}}"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp Accept</a>
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('AccountController@destroy', ['id' => $account->id])}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp Deny</a>
				</div>
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>
@endif
@stop