@extends('layouts.master')

@section('title', 'Purchase List')

@section('content')
<div class="page-header">
	<h1>
		Purchases
		@if ($user->hasRole('finance_manager'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('PurchaseController@create')}}">
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
			<th class="col-md-4">Name of purchase</th>
			<th class="col-md-4">Description</th>
			<th class="col-md-4">Location</th>
		</tr>
		@foreach($purchases as $purchase)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('PurchaseController@show', ['id' => $purchase->id]) }}">
					{{ $purchase->title }}
				</a>
			</td>
			<th class="col-md-4">
				{{ $purchase->description }}
			</th>
			<td class="col-md-4">
				{{ $purchase->longitude }} , {{ $purchase->latitude }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop