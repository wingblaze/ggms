@extends('layouts.master')

@section('title', 'Create Product')

@section('content')
<div class="page-header">
	<h1>Create a new Product</h1>
	<p>This process allows you to add a new product of the golf course.</p>
	@include('partials.error', ['title' => 'Product creation failed'])
</div>

{!! Form::open(array('action' => 'ProductController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="product_code">Product Code</label>
		<input type="text" class="form-control" id="product_code" name="product_code">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="name">Product Name</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="price">Price</label>
		<input type="number" class="form-control" id="price" name="price">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-md col-md-12">
		<label for="description">Description</label>
		<input type="text" class="form-control" id="description" name="description">
		<span id="helpBlock" class="help-block">A short description of this product.</span>
	</div>
	
</div>
	<button type="submit" class="btn btn-primary">Create product</button>
</form>
@stop