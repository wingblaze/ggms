@extends('layouts.master')

@section('title', 'User Profile')

@section('content')

<div class="page-header">
	<h1>View user <BR />
	<small>{{ $target_user->salutation or '' }} {{ $target_user->display_name }}</small>

		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('UserController@edit', $target_user->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('UserController@destroy', $target_user->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>
</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>E-mail</label><BR />
			{{ $target_user->email }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Mobile Number</label><BR />
			{{ $target_user->mobile_number }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Birth Date</label><BR />
			{{ $target_user->birth_date }}
		</div>
		<div class="col-md-8 form-group form-height-xs">
			<label>Birth place</label><BR />
			{{ $target_user->birth_place }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Nationality</label><BR />
			{{ $target_user->nationality }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Gender</label><BR />
			{{ $target_user->gender }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Civil status</label><BR />
			{{ $target_user->civil_status }}
		</p></div>
	</div>

<div class="row">
@if ($target_user->account_type != NULL)

	<div class="col-md-4 form-group form-height-xs">
		<label>Membership type</label><BR />
			{{ $target_user->account_type }}
	</div>


@endif
	
	<div class="col-md-4 form-group form-height-xs">
	<label>Date of creation (user)</label><BR />
	{!! display_readable_date($target_user->created_at) !!}
	</div>

	<div class="col-md-4 form-group form-height-xs">
		<label>Date last updated (user information)</label><BR />
		{!! display_readable_date($target_user->updated_at) !!}
	</div>
</div>
@stop