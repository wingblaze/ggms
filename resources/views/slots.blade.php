@extends('layouts.master')

@section('title', 'Membership Slots')

@section('content')
<div class="page-header">
	<h1>Membership Slots</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th class="col-md-1">Slot ID</th>
			<th class="col-md-2">Slot type</th>
			<th class="col-md-3">Slot description</th>
			<th class="col-md-2">Owned by</th>
			<th class="col-md-3">Options</th>
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
				@if ($slot->owner())
				    {{ $slot->owner()->display_name }}
			    @else
			      	-
			    @endif
			</td>
			<td class="col-md-3">
					<a class="btn btn-sm btn-default" href="{{action('MembershipSlotController@edit', ['id' => $slot->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
					&nbsp
					<a class="btn btn-sm btn-danger" href="{{action('MembershipSlotController@destroy', ['id' => $slot->id])}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp Delete</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@stop