@extends('layouts.master')

@section('title', 'View Account')

@section('content')
<div class="page-header">
	<h1>Account details</h1>
</div>



<div class="page-header">
	<h3>Members under this account</h3>
	<p class="help-block">A single account can have at most one owner, and have multiple dependents.</p>
</div>
@if ($user->hasRole('membership_manager'))
	<p class="help-block">As the membership manager of this golf course community, you may <a href="{{action('AccountController@assign', ['id' => $account->id])}}"><button class="btn btn-primary">assign an existing user</button></a> to this account as either a dependent or an owner.
	@endif
@if (count($account->users) == 0)
	<p class="help-block">There are currently no members assigned to this account.</p>
@else
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
@endif

@if($account->status == 'On Review')
	<div class="page-header">
		<h3>Application undergoing review</h3>
	</div>
	@if ($user->hasRole('user'))
		<p class="help-block">As a member of this golf course community, you may <a class="btn btn-default btn-sm" href="{{ url('review', ['id' => $account->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp review this account</a> and share with us your thoughts or report any issues with this new application.</p>
		@endif
		<p class="help-block">This account is currently <span class="label label-warning">pending</span> and is undergoing the review process of the existing members.</p>
	@if (count($complaints) == 0)

		<p class="help-block">There are currently no complaints on this account.</p>
	@else
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
						
						<a class="btn btn-sm btn-default" href="{{action('AccountController@show', ['id' => $complaint->owner->account->id])}}">Account details</a>
						@if ($user->hasRole('membership_manager'))
						<a class="btn btn-sm btn-default" href="{{action('AccountController@edit', ['id' => $complaint->owner->account->id])}}">Edit</a>
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

@endif

<div class="page-header">
	<h3>Account information</h3>
</div>
<div>
	<p>
		<label>id</label><BR />
		{{ $account->id }}
	</p>
	<p>
		<label>tin_number</label><BR />
		{{ $account->tin_number }}
	</p>
	<p>
		<label>home_address</label><BR />
		{{ $account->home_address }}
	</p>
	<p>
		<label>business_address</label><BR />
		{{ $account->business_address }}
	</p>
	<p>
		<label>bank_account</label><BR />
		{{ $account->bank_account }}
	</p>
	<p>
		<label>credit_card_number</label><BR />
		{{ $account->credit_card_number }}
	</p>
	<p>
		<label>group_id</label><BR />
		{{ $account->group_id }}
	</p>
	<p>
		<label>residence_certificate_id</label><BR />
		{{ $account->residence_certificate_id }}
	</p>
	<p>
		<label>residence_certificate_place_issued</label><BR />
		{{ $account->residence_certificate_place_issued }}
	</p>
	<p>
		<label>residence_certificate_date_issued</label><BR />
		{{ $account->residence_certificate_date_issued }}
	</p>
	<p>
		<label>expiration</label><BR />
		{{ $account->expiration }}
	</p>
	<p>
		<label>address</label><BR />
		{{ $account->address }}
	</p>
	<p>
		<label>phone</label><BR />
		{{ $account->phone }}
	</p>
	<p>
		<label>fax</label><BR />
		{{ $account->fax }}
	</p>
	<p>
		<label>email</label><BR />
		{{ $account->email }}
	</p>
	<p>
		<label>date_approved</label><BR />
		{{ $account->date_approved }}
	</p>
	<p>
		<label>status</label><BR />
		{{ $account->status }}
	</p>
	<p>
		<label>remember_token</label><BR />
		{{ $account->remember_token }}
	</p>
	<p>
		<label>created_at</label><BR />
		{{ $account->created_at }}
	</p>
	<p>
		<label>updated_at</label><BR />
		{{ $account->updated_at }}
	</p>
	<p>
		<label>deleted_at</label><BR />
		{{ $account->deleted_at }}
	</p>
</div>
	
@stop