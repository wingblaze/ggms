@extends('layouts.master')

@section('title', 'Maintenance of Resources')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Maintenance of Golf Facilities</h1>
  @include('partials.error', ['title' => 'Maintenance posting failed'])
  <p class="help-block">As the maintenance manager, you may mark certain golf facilties to be under maintenance. You can 
    <a href="{{ action('ResourceController@index') }}">click here to view the list of facilities</a>.
  </p>
</div>

{!! Form::open(array('action' => 'ResourceController@store_rent')) !!}
<div class="row">
  <div class="form-group form-height-sm col-md-6">
    <label for="resource_name">Name of Flight</label>
    <input type="text" class="form-control" id="resource_name" name="resource" placeholder="e.g. Flight 3" data-provide="typeahead" autocomplete="off">
  </div>

  <div class="form-group form-height-sm col-md-6">
    <label for="client_name">Name of client</label>
    <input type="text" class="form-control" id="client_name" name="client" placeholder="Name of client" data-provide="typeahead" autocomplete="off">
  </div>
</div>


<div class="row">
  <div class="form-group form-height-sm col-md-6">
    <label for="date">Rent start time</label>
          <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" name="start" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
      <script type="text/javascript">
      $(function () {
        $('#datetimepicker1').datetimepicker({
          minDate: moment().add(-1, 'hour'),
          useCurrent: false,
          sideBySide: true,
          stepping: 5
        });
      });
      </script>
    </div>
  </div>

  <div class="form-group form-height-sm col-md-6">
    <label for="date">Rent end time</label>
          <div class='input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" name="end" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
      <script type="text/javascript">
      $(function () {
        $('#datetimepicker2').datetimepicker({
          useCurrent: false,
          sideBySide: true,
          minDate: moment().add(-1, 'hour'),
          stepping: 5

        });
      });
      $("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        $('#datetimepicker2').data("DateTimePicker").maxDate(moment(e.date).add(1, 'Day'));
      });
      $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").minDate(moment(e.date));
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
      });
      
      </script>
    </div>
  </div>
</div>

  <hr>
  <p>Once the form is submitted, the facility will be marked as under maintenance.
    As the maintenance manager, you can modify the status of this maintenance afterwards.</p>
  <button type="submit" class="btn btn-primary">Rent facility</button>
{!! Form::close() !!}

<script type="text/javascript">
  $.get('/config/resources_golf.json', function(data){
    $("#resource_name").typeahead({ source:data });
  },'json');

  $.get('/users.json', function(data){
    $("#client_name").typeahead({ source:data });
  },'json');
</script>
@stop