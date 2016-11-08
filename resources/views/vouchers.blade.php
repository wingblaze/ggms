@extends('layouts.master')

@section('title', 'Voucher List')

@section('content')
<div class="page-header">
	<h1>
		Vouchers
		@if ($user->hasRole('membership_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('VoucherController@create')}}">
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
			<th class="col-md-4">Voucher for</th>
			<th class="col-md-4">Vouched by</th>
			<th class="col-md-4">Remarks</th>
		</tr>
		@foreach($vouchers as $voucher)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('VoucherController@show', ['id' => $voucher->id]) }}">
					{{ $voucher->user->displayName }}
				</a>
			</td>
			<td class="col-md-4">
				{{ $voucher->member->displayName }}
			</td>
			<td class="col-md-4">
				{{ $voucher->remarks }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop