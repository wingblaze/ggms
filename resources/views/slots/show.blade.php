@extends('layouts.master')

@section('title', 'Membership Slot')

@section('content')
<div class="page-header">
	<h1>
		View membership slot <small>{{ $slot->type }}</small>
		<div class="pull-right">
			<a class="btn btn-default" href="{{action('MembershipSlotController@edit', $slot->id)}}">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				&nbsp Edit
			</a>
			<a class="btn btn-danger" href="{{action('MembershipSlotController@destroy', $slot->id)}}">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				&nbsp Disable
			</a>
		</div>
	</h1>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-sm">
		<label>Membership slot number</label><BR />
		{{ $slot->id }}
	</div>
	<div class="col-md-8 form-group form-height-sm">
		<label>Description</label><BR />
		{{ $slot->description }}
	</div>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-xs">
		<label>Date created (Membership slot)</label><BR />
		{!! display_precise_date($slot->created_at) !!}
	</div>
	<div class="col-md-4 form-group form-height-xs">
		<label>Date last updated (Membership slot information)</label><BR />
		{!! display_precise_date($slot->updated_at) !!}
	</div>
</div>
@stop