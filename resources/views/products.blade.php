@extends('layouts.master')

@section('title', 'Product List')

@section('content')
<div class="page-header">
	<h1>
		Products
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('ProductController@create')}}">
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
			<th class="col-md-3">Product code</th>
			<th class="col-md-3">Name of product</th>
			<th class="col-md-3">Description</th>
			<th class="col-md-3">Price</th>
		</tr>
		@foreach($products as $product)
		<tr>
			<td class="col-md-4">
				{{ $product->product_code }}
			</td>
			<td class="col-md-4">
				<a href="{{ action('ProductController@show', ['id' => $product->id]) }}">
					{{ $product->name }}
				</a>
			</td>
			<th class="col-md-4">
				{{ $product->description }}
			</th>
			<td class="col-md-4">
				{{ $product->price }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop