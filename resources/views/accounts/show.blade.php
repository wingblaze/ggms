@extends('layouts.master')

@section('title', 'View Account')

@section('content')
<div class="page-header">
	<h1>Viewing account details</h1>
</div>

@if ($account->owner())
<p>The account owner is {{ $account->owner()->name}}.</p>
@else
<p>This account currently has no owner yet.</p>
@endif

<div class="page-header">
	<h3>Members under this account</h3>
	<span>A single account can have at most one owner, and have multiple dependents.</span>
	@if ($user->hasRole('membership_manager'))
	<p>As the membership manager of this golf course community, you may <a href="{{action('AccountController@assign', ['id' => $account->id])}}"><button class="btn btn-primary">assign an existing user</button></a> to this account as either a dependent or an owner.
	@endif
	<p>
		
	</p>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-6">Member</th>
			<th class="col-md-2">Account type</th>
		</tr>
		@foreach($account->users as $user)
		<tr>
			<td class="col-md-6">
				@if ($user)
				<a href="{{action('UserController@show', ['id' => $user->id])}}">
					{{ $user->name }}
				</a>
				@else
					None
				@endif
			</td>
			<td class="col-md-2">
				{{ $user->account_type }}
			</td>
		</tr>
		@endforeach
	</table>
</div>

{{ $account->status}}
@if($account->status == 'On Review')
<div class="page-header">
	<h3>Application undergoing review</h3>
	<span>This account is currently <span class="label label-warning">pending</span> and is undergoing the review process of the existing members.</span>
	@if ($user->hasRole('user'))
	<p>As a member of this golf course community, you may <a class="btn btn-default btn-sm" href="{{ url('review', ['id' => $account->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp review this account</a> and share with us your thoughts or report any issues with this new application.</p>
	@endif
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-4">Complaint by</th>
			<th class="col-md-2">Content</th>
			<th class="col-md-2">Date posted</th>
			<th class="col-md-3">Options</th>
		</tr>
		@foreach($complaints as $complaint)
		<tr>
			<td class="col-md-4">
				@if ($complaint->owner)
				<a href="{{action('UserController@show', ['id' => $complaint->owner->id])}}">
					{{ $complaint->owner->name }}
				</a>
				@else
					No owner
				@endif
			</td>
			<td class="col-md-2">
				{{ $complaint->content or 'No reason indicated' }}
			</td>
			<td class="col-md-2">
				{{ $complaint->created_at or 'Now' }}
			</td>
			<td class="col-md-3">
				<div class="btn-group" role="group" aria-label="Options">
					
					<a class="btn btn-sm btn-default" href="{{action('AccountController@show', ['id' => $complaint->id])}}">Account details</a>
					@if ($user->hasRole('membership_manager'))
					<a class="btn btn-sm btn-default" href="{{action('AccountController@edit', ['id' => $complaint->id])}}">Edit</a>
					@endif
					
				</div>
				@if ($user->hasRole('membership_manager'))
				&nbsp
				<a class="btn btn-sm btn-danger" href="{{action('AccountController@destroy', ['id' => $complaint->id])}}">Delete</a>
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>
@endif
	
@stop