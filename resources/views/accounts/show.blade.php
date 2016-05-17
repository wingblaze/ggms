@extends('layouts.master')

@section('title', 'View Account')

@section('content')
<div class="page-header">
	<h1>
		Account details
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('AccountController@edit', $account->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('AccountController@destroy', $account->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>

</div>

<div class="page-header">
	<h3>Members under this account</h3>
	<p class="help-block">A single account can have at most one owner, and have multiple dependents.</p>
</div>
@if ($user->hasRole('membership_manager'))
	<p class="help-block">As the membership manager of this golf course community, you may <a href="{{action('AccountController@assign', ['id' => $account->id])}}"><button class="btn btn-default">assign an existing user</button></a> to this account as either a dependent or an owner.
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
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Account review details</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	<div class="modal-header">
	<h3 class="modal-title">Application undergoing review</h3>
	</div>
		<div class="modal-body">
		
			This account is currently pending and is undergoing the review process of the existing members.</p>
		@if (count($complaints) == 0)

			<p class="help-block">There are currently no complaints on this account.</p>
		@else
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th class="col-md-4">Complaint by</th>
					<th class="col-md-6">Content</th>
					<th class="col-md-2 hidden-xs">Date posted</th>
				</tr>
				@foreach($complaints as $complaint)
				<tr>
					<td class="col-md-4">
						@if ($complaint->owner)
						<a href="{{action('UserController@show', ['id' => $complaint->owner->id])}}">
							{{ $complaint->owner->display_name }}
						</a>
						@else
							No owner
						@endif
					</td>
					<td class="col-md-6">
						{{ $complaint->content or 'No reason indicated' }}
					</td>
					<td class="col-md-2 hidden-xs">
						{!! display_precise_date($complaint->created_at) !!}
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		@endif
		</div>
		<div class="modal-footer">
		@if ($user->hasRole('user'))
			<p class="help-block">As a member of this golf course community, you may review this account and share with us your thoughts or report any issues with this new application.
		</p>
		
		<a class="btn btn-primary" href="{{ url('review', ['id' => $account->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Review this account</a>
		@endif
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	</div>

  </div>
</div>



@endif
@if ($account->remarks != NULL)
<div class="page-header">
	<h3>Financial information</h3>
	
</div>
<div>
	<p>
		<label>Remarks</label><BR />
		{{ $account->remarks or '-' }}<BR />
		@if ($user->hasRole('finance_manager'))
			<p class="help-block">As finance manager, you may mark this account as cleared once the user has finished payment.</p>
			<a class="btn btn-sm btn-primary" href="{{ action('AccountController@clear_payment', $account->id) }}">Clear account</a> 
		@endif
	</p>
@endif


<div>
	<h3>Contact details</h3>
	
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
		<label>Home address</label><BR />
		{{ $account->home_address or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Business address</label><BR />
		{{ $account->business_address or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Address</label><BR />
		{{ $account->address or '-' }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
		<label>Phone</label><BR />
		{{ $account->phone or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Fax</label><BR />
		{{ $account->fax or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Email</label><BR />
		{{ $account->email or '-' }}
		</div>
	</div>

	@if ($user->hasRole('finance_manager') || $user->account && $user->account->id == $account->id)
		<h3>Financial information</h3>
		<div class="row">
			<div class="col-md-4 form-group form-height-xs">
			<label>Bank account number</label><BR />
			{{ $account->bank_account or '-' }}
			</div>
			<div class="col-md-4 form-group form-height-xs">
			<label>Credit card number</label><BR />
			{{ $account->credit_card_number or '-' }}
			</div>
		</div>
	@endif

	<h3>Account information</h3>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Account ID</label><BR />
			{{ $account->id or '-' }}	
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Group or affiliation</label><BR />
		@if ($account->group_id)
			{{ App\Group::find($account->group_id)->name }}
		@else
			N/A
		@endif
		</div>
		@if ($user->hasRole('membership_manager'))
			<div class="col-md-4 form-group form-height-xs">
			<label>TIN number</label><BR />
			{{ $account->tin_number or '-' }}
			</div>
		@endif
	</div>
	@if ($user->hasRole('membership_manager'))
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
		<label>Residence certificate ID</label><BR />
		{{ $account->residence_certificate_id or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Place issued (residence certificate)</label><BR />
		{{ $account->residence_certificate_place_issued or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Date issued (residence certificate)</label><BR />
		{!! display_precise_date($account->residence_certificate_date_issued) !!}
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
		<label>Date application was filled</label><BR />
		{!! display_precise_date($account->created_at) !!}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Date of application approval</label><BR />
		{!! display_precise_date($account->date_approved) !!}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Account expiration</label><BR />
		{!! display_precise_date($account->expiration) !!}
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
		<label>Account status</label><BR />
		{{ $account->status or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Date last updated (account information)</label><BR />
		{!! display_precise_date($account->updated_at) !!}
		</div>
		<div class="col-md-4 form-group form-height-xs">
		<label>Date of deletion (account)</label><BR />
		{!! display_precise_date($account->deleted_at) !!}
		</div>
	</div>
</div>
	
@stop