@extends('layouts.master')

@section('title', 'Terminal List')

@section('content')
<div class="page-header">
	<h1>
		Terminals
		@if ($user->hasRole('system_administrator'))
			<div class="pull-right">
				<a class="btn btn-primary" href="{{action('TerminalController@create')}}">
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
			<th class="col-md-4">Name of terminal</th>
			<th class="col-md-4">Description</th>
			<th class="col-md-4">Location</th>
		</tr>
		@foreach($terminals as $terminal)
		<tr>
			<td class="col-md-4">
				<a href="{{ action('TerminalController@show', ['id' => $terminal->id]) }}">
					{{ $terminal->title }}
				</a>
			</td>
			<th class="col-md-4">
				{{ $terminal->description }}
			</th>
			<td class="col-md-4">
				{{ $terminal->longitude }} , {{ $terminal->latitude }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop