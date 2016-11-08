@extends('layouts.master')

@section('title', 'Vehicle Registration')

@section('content')
<div class="page-header">
	<h1>
		Vehicle registration forms
		@if ($user->hasRole(['user', 'membership_manager']))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('ApplicationController@create', ['type' => 'vehicle_registration'])}}">
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
			<th class="col-md-4">Name of applicant</th>
			<th class="col-md-4">Details</th>
		</tr>
		@foreach($apps as $app)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('ApplicationController@index', ['type' => 'vehicle_registration']) }}">
					Vehicle Registration Form
				</a>
			</td>
			<td class="col-md-4">
				Members can ask to register their vehicles.
				</td>
			</tr>
		@endforeach	
		</table>
	</div>
	@stop