@extends('layouts.master')

@section('title', 'Editing Voucher')

@section('content')
<div class="page-header">
	<h1>Editing a Voucher</h1>
	@include('partials.error', ['title' => 'Voucher update failed'])
</div>

{!! Form::model($voucher, ['method' => 'PATCH', 'route' => ['vouchers.update', $voucher]]) !!}
<div class="row">
	<div class="form-group form-height-md col-md-4">
	  <label for="user_id">Voucher for</label>
	    <input type="text" class="form-control" id="user_id" name="user_id" data-provide="typeahead" autocomplete="off" required value="{{ $voucher->user->displayName }} - {{ $voucher->user->id }}">
	</div>
	<div class="form-group form-height-md col-md-4">
	  <label for="member_id">Vouched by</label>
	    <input type="text" class="form-control" id="member_id" name="member_id" data-provide="typeahead" autocomplete="off" required value="{{ $voucher->member->displayName }} - {{ $voucher->member->id }}">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-12">
		<label for="remarks">Remarks</label>
		<input type="text" class="form-control" id="remarks" name="remarks" value="{{ $voucher->remarks }}">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Update voucher</button>
{!! Form::close() !!}
@stop