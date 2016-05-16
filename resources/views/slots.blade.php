@extends('layouts.master')

@section('title', 'Membership Slots')

@section('content')
<div class="page-header">
	<h1
		>Membership Slots
		<div class="pull-right">
			<a class="btn btn-primary" href="{{action('MembershipSlotController@create')}}">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				&nbsp New
			</a>
		</div>
	</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-1">Slot ID</th>
			<th class="col-md-2">Slot type</th>
			<th class="col-md-3">Slot description</th>
			<th class="col-md-2">Owned by</th>
		</tr>
		@foreach($slots as $slot)
		<tr>
			<td class="col-md-1">
					{{ $slot->id }}
			</td>
			<td class="col-md-2">
				<a href="{{ action('MembershipSlotController@show', ['id' => $slot->id]) }}">
					{{ $slot->type }}
				</a>
			</td>
			<td class="col-md-3">
				{{ $slot->description }}
			</td>
			<td class="col-md-2">
				@if ($slot->account() && $slot->account()->owner())
				    {{ $slot->account()->owner()->display_name }}
			    @else
			      	-
			    @endif
			</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop