@extends('layouts.master')

@section('title', 'Asset')

@section('content')

<div class="page-header">
	<h1>View asset
	
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-default" href="{{action('AssetController@edit', $asset->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					&nbsp Edit
				</a>
				<a class="btn btn-danger" href="{{action('AssetController@destroy', $asset->id)}}">
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
			{{ $asset->name or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Description</label><BR />
			{{ $asset->description or '-' }}
		</div>
		<div class="col-md-4 form-group form-height-xs">
			<label>Value</label><BR />
			{{ $asset->value or '-' }}
		</div>
	</div>
@stop