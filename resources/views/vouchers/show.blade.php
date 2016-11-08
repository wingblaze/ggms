@extends('layouts.master')

@section('title', 'Voucher')

@section('content')

<div class="page-header">
	<h1>View voucher
	
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('VoucherController@edit', $voucher->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('VoucherController@destroy', $voucher->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>
</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Voucher for</label><BR />
			{{ $voucher->user->displayName or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Vouched by</label><BR />
			{{ $voucher->member->displayName or '-' }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Time created</label><BR />
			{{ $voucher->created_at or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Time last updated</label><BR />
			{{ $voucher->updated_at or '-' }}
		</div>		
	</div>
@stop