@extends('layouts.master')

@section('title', 'Register a Vehicle')

@section('content')
<div class="page-header">
	<h1>Register a new vehicle</h1>
	<p>This process description... etc</p>
	@include('partials.error', ['title' => 'Register a vehicle failed'])
</div>

{!! Form::open(array('action' => 'ApplicationController@store')) !!}
{!! Form::hidden('type', 'vehicle_registration') !!}
<div class="row">
<h3>Vehicle details</h3>
	<div class="form-group form-height-md col-md-4">
		<label for="vehicle_type">Vehicle type</label>
		<div class="row">
			<div class="col-md-6">
				<label class="radio-inline">
					<input type="radio" value="car" name="vehicle_type">
					Car
				</label>
			</div>
			<div class="col-md-6">
				<label class="radio-inline">
					<input type="radio" value="golf_cart" name="vehicle_type">
					Golf Cart
				</label>
			</div>
		</div>
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="plate_number">Plate number (if valid)</label>
		<input type="text" class="form-control" id="name" name="plate_number" placeholder="">
	</div>
	<div class="form-group form-height-md col-md-4">
		<label for="vehicle_color">Vehicle color</label>
		<input type="text" class="form-control" id="name" name="vehicle_color" placeholder="">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-12">
		<label for="date">Include for maintenance?</label>
					<input type="checkbox" class="form-control" id="maintenance" name="maintenance" placeholder="">
					Yes, please include maintenance
				
		
		
	</div>
</div>

<hr>
<p>The application process will be reviewed by ... etc.</p>
	<button type="submit" class="btn btn-primary">Submit application form</button>
</form>
@stop