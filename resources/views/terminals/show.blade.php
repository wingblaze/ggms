@extends('layouts.master')

@section('title', 'Terminal')

@section('content')

<div class="page-header">
	<h1>View terminal
	
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('TerminalController@edit', $terminal->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('TerminalController@destroy', $terminal->id)}}">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					&nbsp Disable
				</a>
			</div>
		@endif
	</h1>
</div>

	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Name</label><BR />
			{{ $terminal->title or '-' }}
		</div>
		<div class="col-md-8 form-group form-height-xs">
			<label>Description</label><BR />
			{{ $terminal->description or '-' }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group form-height-xs">
			<label>Longitude</label><BR />
			{{ $terminal->longitude or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Latitude</label><BR />
			{{ $terminal->latitude or '-' }}
		</div>		
	</div>
@stop