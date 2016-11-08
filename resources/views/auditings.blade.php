@extends('layouts.master')

@section('title', 'Auditing List')

@section('content')
<div class="page-header">
	<h1>
		Auditings
	</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-3">Actor</th>
			<th class="col-md-3">Category</th>
			<th class="col-md-3">Action</th>
			<th class="col-md-3">Label</th>
		</tr>
		@foreach($auditings as $auditing)
		<tr>
			<td class="col-md-3">
				<a href="{{ action('AuditingController@show', ['id' => $auditing->id]) }}">
					{{ $auditing->user->displayName }}
				</a>
			</td>
			<th class="col-md-3">
				{{ $auditing->category }}
			</th>
			<th class="col-md-3">
				{{ $auditing->action }}
			</th>
			<td class="col-md-3">
				{{ $auditing->value }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop