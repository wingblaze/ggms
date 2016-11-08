@extends('layouts.master')

@section('title', 'Application Forms')

@section('content')
<div class="page-header">
	<h1>
		Application forms
	</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-4">Name of application form</th>
			<th class="col-md-4">Description</th>
		</tr>
		
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
			
		</table>
	</div>
	@stop