@extends('layouts.master')

@section('title', 'Create Purchase')

@section('content')
<div class="page-header">
	<h1>Create a new Purchase</h1>
	<p>This process allows you to add a new purchase of the golf course.</p>
	@include('partials.error', ['title' => 'Purchase creation failed'])
</div>

{!! Form::open(array('action' => 'PurchaseController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="billing_id">Billing ID</label>
		<input type="text" class="form-control" id="billing_id" name="billing_id">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="product_id">Product ID</label>
		<input type="text" class="form-control" id="product_id" name="product_id">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="price_override">Price override</label>
		<input type="number" class="form-control" id="price_override" name="price_override">
		<span id="helpBlock" class="help-block">Leave this blank if you wish to use the price set by the product.</span>
	</div>
</div>
	<button type="submit" class="btn btn-primary">Create purchase</button>
</form>
@stop