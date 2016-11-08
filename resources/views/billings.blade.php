@extends('layouts.master')

@section('title', 'Billing List')

@section('content')
<div class="page-header">
	<h1>
		Billings
		@if ($user->hasRole('finance_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('BillingController@create')}}">
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
			<th class="col-md-4">Name of billing</th>
			<th class="col-md-4">Description</th>
			<th class="col-md-4">Value</th>
		</tr>
		@foreach($billings as $billing)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('BillingController@show', ['id' => $billing->id]) }}">
					{{ $billing->name }}
				</a>
			</td>
			<th class="col-md-4">
				{{ $billing->description }}
			</th>
			<td class="col-md-4">
				{{ $billing->value }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop