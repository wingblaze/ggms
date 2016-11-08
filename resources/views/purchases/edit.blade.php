@extends('layouts.master')

@section('title', 'Editing Product')

@section('content')
<div class="page-header">
	<h1>Editing a Product</h1>
	@include('partials.error', ['title' => 'Product update failed'])
</div>

{!! Form::model($product, ['method' => 'PATCH', 'route' => ['products.update', $product]]) !!}
<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="product_code">Product Code</label>
		<input type="text" class="form-control" id="product_code" name="product_code" value="{{ $product->product_code }}">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="name">Product Name</label>
		<input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="price">Price</label>
		<input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-md col-md-12">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
		<span id="helpBlock" class="help-block">A short description of this product.</span>
	</div>
</div>
	<button type="submit" class="btn btn-primary">Update product</button>
{!! Form::close() !!}
@stop