@extends('layouts.master')

@section('title', 'Create new membership slot')

@section('content')
<div class="page-header">
	<h1>Create new membership slot</h1>
	<p>This process allows you to create a new membership slot.</p>
	@include('partials.error', ['title' => 'Membership slot creation failed'])
</div>

{!! Form::open(array('action' => 'MembershipSlotController@store')) !!}
<div class="form-group">
	<label for="salutation">Type</label>
	<input type="text" class="form-control" id="type" name="type" placeholder="i.e. Standard, Premium">
</div>
<div class="form-group">
	<label for="name">Description</label>
	<textarea type="text" class="form-control" id="description" name="description">
	</textarea>
</div>
	<button type="submit" class="btn btn-primary">Create membership slot</button>
</form>
@stop