@extends('layouts.master')

@section('title', 'Report')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<style>

body {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
  fill: #008800;
}

.bar:hover {
  fill: #22AA22;
}

.x.axis path {
  display: none;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}
</style>

@endsection

@section('content')
<div class="page-header">
	<h1>{{ ucwords($report->title) }}</h1>
  @if (isset($report->description))
    <span id="helpBlock" class="help-block">{{ $report->description }}</span>
  @endif
</div>

<?PHP
$name = Route::getCurrentRoute()->getActionName();
$name = preg_split('[@]', $name);
$name = $name[1];
?>

{!! Form::open(array('action' => 'ReportController@' . $name )) !!}
  <h3>Parameters</h3>
  

  <?php $dateCounter = 0; ?>
    @foreach ($fields as $field_name => $field)
    <?PHP $words = preg_split('/(?=[A-Z])/', $field_name);  $field_name_display = implode(' ', $words); $dateCounter++; ?>
      @if ($field)
        @if ($field->type == 'text')
        <div class="form-group">
          <label for="{{ $field_name }}"> {{ ucwords($field_name_display) }} </label>
          @if (isset($field->description))
            <span id="helpBlock" class="help-block">{{ $field->description }}</span>
          @endif
          <input type="text" class="form-control" id="{{ $field_name }}" name="{{ $field_name }}" data-provide="typeahead" autocomplete="off" value="{{ $data[$field_name] or '' }}">
        </div> 
        @elseif ($field->type == 'date')
          <div class="form-group">
            <label for="{{ $field_name }}"> {{ucwords($field_name_display) }} </label>
            @if (isset($field->description))
              <span id="helpBlock" class="help-block">{{ $field->description }}</span>
            @endif
            <div class="row">
              <div class='col-sm-6'>
                <div class="form-group">
                  <div class='input-group date' id='datetimepicker{{ $dateCounter }}'>
                    <input type='text' class="form-control" name="{{ $field_name }}" value="{{ $data[$field_name] or '' }}" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
              $(function () {
                $('#datetimepicker{{ $dateCounter }}').datetimepicker({
                  format: 'YYYY-MM-DD'
                });
              });
              </script>
            </div>
          </div>
        @elseif ($field->type == 'graph')
          <div class="form-group">
            <label for="graphInterval">Select list:</label>
            @if (isset($field->description))
              <span id="helpBlock" class="help-block">{{ $field->description }}</span>
            @endif
            <select class="form-control" id="graphInterval" name="graphInterval">

              <option {{ (isset($data['graphInterval']) && $data['graphInterval'] == 'Day') ? 'selected' : '' }}>Day</option>
              <option {{ (isset($data['graphInterval']) && $data['graphInterval'] == 'Week') ? 'selected' : '' }}>Week</option>
              <option {{ (isset($data['graphInterval']) == false || $data['graphInterval'] == 'Month') ? 'selected' : '' }}>Month</option>
            </select>
          </div>
        @endif
      @endif
    @endforeach
  
  <button type="submit" class="btn btn-primary">Generate report</button>
  {!! Form::close() !!}

  <hr>


@if ( isset($report->data) )
<div class="container">
  <h1>Report</h1>
  <div id="report">
  </div>
</div>


<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script>

var margin = {top: 40, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>{{ ucwords($report->data['y']) }} of " + d.{{ $report->data['x'] }} + ":</strong> <span style='color: #BBFFBB'>" + d.{{ $report->data['y'] }} + "</span>";
  })

var svg = d3.select("#report").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

d3.tsv("{{ $report->data['url'] }}", type, function(error, data) {
  x.domain(data.map(function(d) { return d.{{ $report->data['x'] }}; }));
  y.domain([0, d3.max(data, function(d) { return d.{{ $report->data['y'] }}; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Count");

  svg.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.{{ $report->data['x'] }}); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.{{ $report->data['y'] }}); })
      .attr("height", function(d) { return height - y(d.{{ $report->data['y'] }}); })
      .on('mouseover', tip.show)
      .on('mouseout', tip.hide)

});

function type(d) {
  d.{{ $report->data['y'] }} = +d.{{ $report->data['y'] }};
  return d;
}

</script>
@endif

<script type="text/javascript">
  @foreach ($fields as $field_name => $field)
    @if(property_exists($field, 'autocomplete'))
      $.get('{{ url($field->autocomplete) }}', function(data){
        $("#{{ $field_name }}").typeahead({ source:data });
      },'json');
    @endif
  @endforeach
</script>
@stop