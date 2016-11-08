@extends('layouts.master')

@section('title', 'Asset List')

@section('content')
<div class="page-header">
	<h1>
		Assets
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('AssetController@create')}}">
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
			<th class="col-md-4">Name of asset</th>
			<th class="col-md-4">Description</th>
			<th class="col-md-4">Value</th>
		</tr>
		@foreach($assets as $asset)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('AssetController@show', ['id' => $asset->id]) }}">
					{{ $asset->name }}
				</a>
			</td>
			<th class="col-md-4">
				{{ $asset->description }}
			</th>
			<td class="col-md-4">
				{{ $asset->value }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop