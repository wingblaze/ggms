@extends('layouts.master')

@section('title', 'Create Voucher')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection


@section('content')
<div class="page-header">
	<h1>Create a new Voucher</h1>
	<p>This process allows you to add a new voucher, where an employee can handle a member.</p>
	@include('partials.error', ['title' => 'Voucher creation failed'])
</div>

{!! Form::open(array('action' => 'VoucherController@store')) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
	  <label for="user_id">Voucher for</label>
	    <input type="text" class="form-control" id="user_id" name="user_id" data-provide="typeahead" autocomplete="off" required>
	</div>
	<div class="form-group form-height-md col-md-4">
	  <label for="member_id">Vouched by</label>
	    <input type="text" class="form-control" id="member_id" name="member_id" data-provide="typeahead" autocomplete="off" required>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-12">
		<label for="remarks">Remarks</label>
		<input type="text" class="form-control" id="remarks" name="remarks">
	</div>
</div>
	<button type="submit" class="btn btn-primary">Create voucher</button>
</form>

<script type="text/javascript">
  $.get('/users.json', function(data){
    $("#user_id").typeahead({ source:data });
    $("#member_id").typeahead({ source:data });
  },'json');
</script>
@stop