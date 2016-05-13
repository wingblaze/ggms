@extends('layouts.master')

@section('title', 'View Account')

@section('content')
<div class="page-header">
	<h1>
	Account details
	</h1>

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
		@foreach($account->users as $target_user)
		<tr>
			<td class="col-md-6">
				@if ($target_user)
				<a href="{{action('UserController@show', ['id' => $target_user->id])}}">
					{{ $target_user->display_name }}
				</a>
				@else
					None
				@endif
			</td>
			<td class="col-md-2">
				{{ prettify_text($target_user->account_type) }}
			</td>
		</tr>
		@endforeach
	</table>
</div>
@endif

@if (App\MembershipControl::latest_slot_of_account($account->id) == FALSE)
<div class="page-header">
	<h3>No membership slot</h3>
	<p class="help-block"><span class="label label-warning">Warning</span> This account currently does not have a membership slot. Without a membership slot, the user cannot access facilities or post their club share listing.</p>
	@if ($user->hasRole('membership_manager'))
		{!! Form::open(array('action' => 'AccountController@assign_slot')) !!}
		{!! Form::hidden('account_id', $account->id) !!}
			<span id="helpBlock" class="help-block">As membership manager, you may assign an unused membership slot to this account below:</span>
			<div class="form-group">
				<label for="membership_slot">Membership Slot</label>
				<select class="form-control" name="membership_slot">
					<option value="-1">No slot assigned</option>
					@foreach ($slots as $slot)
					<option value="{{ $slot->id }}">Slot {{$slot->id}} - {{ $slot->type}} </option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Assign</button>
		{!! Form::close() !!}
	@endif
</div>
@endif


@if($account->status == 'On Review')
	<div class="page-header">
		<h3>Application undergoing review</h3>
	</div>
	@if ($user->hasRole('user'))
		<p class="help-block">As a member of this golf course community, you may <a class="btn btn-default btn-sm" href="{{ url('review', ['id' => $account->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp review this account</a> and share with us your thoughts or report any issues with this new application.</p>
		@endif
		<p class="help-block"><span class="label label-warning">Pending</span> This account is currently pending and is undergoing the review process of the existing members.</p>
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
@if ($account->remarks != NULL)
<div class="page-header">
	<h3>Financial information</h3>
	
</div>
<div>
	<p>
		<label>Remarks</label><BR />
		{{ $account->remarks or 'N/A' }}<BR />
		@if ($user->hasRole('finance_manager'))
			<p class="help-block">As finance manager, you may mark this account as cleared once the user has finished payment.</p>
			<a class="btn btn-sm btn-primary" href="{{ action('AccountController@clear_payment', $account->id) }}">Clear account</a> 
		@endif
	</p>
@endif
<div class="page-header">
	<h3>Account information</h3>
</div>
<div>
	<p>
		<label>Account ID</label><BR />
		{{ $account->id or 'N/A' }}
	</p>
	<p>
		<label>tin_number</label><BR />
		{{ $account->tin_number or 'N/A' }}
	</p>
	<p>
		<label>home_address</label><BR />
		{{ $account->home_address or 'N/A' }}
	</p>
	<p>
		<label>business_address</label><BR />
		{{ $account->business_address or 'N/A' }}
	</p>
	<p>
		<label>bank_account</label><BR />
		{{ $account->bank_account or 'N/A' }}
	</p>
	<p>
		<label>credit_card_number</label><BR />
		{{ $account->credit_card_number or 'N/A' }}
	</p>
	<p>
		<label>group_id</label><BR />
		{{ $account->group_id or 'N/A' }}
	</p>
	<p>
		<label>residence_certificate_id</label><BR />
		{{ $account->residence_certificate_id or 'N/A' }}
	</p>
	<p>
		<label>residence_certificate_place_issued</label><BR />
		{{ $account->residence_certificate_place_issued or 'N/A' }}
	</p>
	<p>
		<label>residence_certificate_date_issued</label><BR />
		{{ $account->residence_certificate_date_issued or 'N/A' }}
	</p>
	<p>
		<label>expiration</label><BR />
		{{ $account->expiration or 'N/A' }}
	</p>
	<p>
		<label>address</label><BR />
		{{ $account->address or 'N/A' }}
	</p>
	<p>
		<label>phone</label><BR />
		{{ $account->phone or 'N/A' }}
	</p>
	<p>
		<label>fax</label><BR />
		{{ $account->fax or 'N/A' }}
	</p>
	<p>
		<label>email</label><BR />
		{{ $account->email or 'N/A' }}
	</p>
	<p>
		<label>date_approved</label><BR />
		{{ $account->date_approved or 'N/A' }}
	</p>
	<p>
		<label>status</label><BR />
		{{ $account->status or 'N/A' }}
	</p>
	<p>
		<label>created_at</label><BR />
		{{ $account->created_at or 'N/A' }}
	</p>
	<p>
		<label>updated_at</label><BR />
		{{ $account->updated_at or 'N/A' }}
	</p>
	<p>
		<label>deleted_at</label><BR />
		{{ $account->deleted_at or 'N/A' }}
	</p>
</div>
	
@stop