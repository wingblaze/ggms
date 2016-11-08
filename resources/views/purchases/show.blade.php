@extends('layouts.master')

@section('title', 'Product')

@section('content')

<div class="page-header">
	<h1>View product
	
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('ProductController@edit', $product->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('ProductController@destroy', $product->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>
</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Product code</label><BR />
			{{ $product->product_code or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Name</label><BR />
			{{ $product->name or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Price</label><BR />
			{{ $product->price or '-' }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group form-height-xs">
			<label>Description</label><BR />
			{{ $product->description or '-' }}
		</div>
	</div>
@stop