@extends('layouts.master')

@section('title', 'Pending Accounts')

@section('content')
<div class="page-header">
	<h1>Pending accounts</h1>
	<p class="help-block">As existing members of this golf club, you are encouraged to participate in the review phase of the application process.
    Please let us know if there are any complaints on new membership applications.</p>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-4">Membership holder</th>
			<th class="col-md-2">Status</th>
			<th class="col-md-2">Number of complaints</th>
			<th class="col-md-3">Options</th>
		</tr>
		@foreach($accounts as $account)
		<tr>
			<td class="col-md-4">
				@if ($account->owner())
				<a href="{{action('AccountController@show', ['id' => $account->id])}}">
					{{ $account->owner()->name }}
				</a>
				@else
					No owner
				@endif
			</td>
			<td class="col-md-2">
				{{ $account->status }}
			</td>
			<td class="col-md-2">
				{{ App\Complaint::where('account_id', '=', $account->id)->count() }}
			</td>
			<td class="col-md-3">
				<div class="btn-group" role="group" aria-label="Options">
					<a class="btn btn-sm btn-default" href="{{action('AccountController@show', ['id' => $account->id])}}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp Account</a>
					@if ($account->owner())
						<a class="btn btn-sm btn-default" href="{{action('UserController@show', ['id' => $account->owner()->id])}}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp Owner</a>
					@endif
					@if ($user->hasRole('user'))
					<a class="btn btn-sm btn-default" href="{{url('review', ['id' => $account->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Review</a>
					@endif
				
				</div>
				@if ($user && $user->hasRole('membership_manager'))
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('AccountController@destroy', ['id' => $account->id])}}">Deny</a>
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>
@stop