@extends('layouts.master')

@section('title', 'Create Event')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Create a new event</h1>
	@include('partials.error', ['title' => 'Event creation failed'])
	@if ($user->hasRole('marketing_manager'))
	<p class="help-block">As a marketing manager, you may create new events. You may also 
    <a href="{{ action('ResourceController@index') }}">click here to view the list of facilities</a>.
    @endif
  </p>
</div>

{!! Form::open(array('action' => 'EventController@store')) !!}
	<h3>Event details</h3>
	<div class="form-group">
		<label for="name">Name of event</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="Name">
	</div>

	<div class="form-group">
		<label for="description">Description</label>
		<textarea id="description" placeholder="Description" name="description" class="form-control" rows="3"></textarea>
		<span id="helpBlock" class="help-block">The description will be used to give possible attendees an idea of what they will be attending. 
			Be as descriptive and enticing as possible.
		</span>
	</div>

	<div class="form-group">
		<label for="date">Start date and time of event</label>
		<div class="row">
			<div class='col-sm-6'>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control" name="start_date" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
			<script type="text/javascript">
			$(function () {
				$('#datetimepicker1').datetimepicker();
			});
			</script>
		</div>
	</div>

	<div class="form-group">
		<label for="date">End date and time of event</label>
		<div class="row">
			<div class='col-sm-6'>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker2' >
						<input type='text' class="form-control" name="end_date"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
			<script type="text/javascript">
			$(function () {
				$('#datetimepicker2').datetimepicker({
					useCurrent: false
				});
			});
			$("#datetimepicker1").on("dp.change", function (e) {
				$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
			});
			$("#datetimepicker2").on("dp.change", function (e) {
				$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
			});
			</script>
		</div>
	</div>

	<div class="form-group">
		<label for="expected_attendees">Expected number of attendees</label>
		<input type="number" class="form-control" id="expected_attendees" name="expected_attendees" placeholder="Amount">
	</div>
	<div class="form-group">
		<label for="facility">Facility to be rented</label>
		<input type="text" class="form-control" id="resource_name" name="facility" placeholder="Name of facility" data-provide="typeahead" autocomplete="off">
	</div>
	<hr>
	<h3>Preparation details</h3>
	<div class="form-group">
		<p class="help-block">If the person requesting the event is a non-member, you may optionally provide the person's contact details.</p>
		<label for="contact_details">Contact number</label>
		<input type="text" class="form-control" id="resource_name" name="contact_details" placeholder="e.g. 0917-812-3792" data-provide="typeahead" autocomplete="off">
	</div>
	<label>Checklist</label>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="projector"> Projector
			</label>
		</div>
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="chairs"> Chairs
			</label>
		</div>
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="tables"> Tables
			</label>
		</div>
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="dining_setup"> Dining Setup
			</label>
		</div>
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="in_house_cleaning"> In-house Cleaning
			</label>
		</div>
	</div>
	
	<hr>

	<p>Note that the fields above can be edited afterwards after the event is created. It is not permanent.</p>

	<button type="submit" class="btn btn-primary">Create event</button>
</form>
<script type="text/javascript">
  $.get('/config/resources.json', function(data){
    $("#resource_name").typeahead({ source:data });
  },'json');

</script>
@stop