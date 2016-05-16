@extends('layouts.master')

@section('title', 'Club Shares Listing')

@section('content')
<div class="content">
  <h2>My rentals</h2>
  @if (count($listings) == 0)
    <p>You are currently not renting any facilities.</p>
  @else
  <p class="help-block">These are the facilities you have rented or are currently renting.</p>
  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th class="col-md-4">Name of Facility</th>
        <th class="col-md-1 visible-xs">Duration</th>
        <th class="col-md-3 hidden-xs">Rental start time</th>
        <th class="col-md-3 hidden-xs">Rental end time</th>
        <th class="col-md-1 hidden-xs">Status</th>
      </tr>
      <?php 
        $now = Carbon\Carbon::now();
      ?>
      @foreach($listings as $listing)
      <?php 
        $start = Carbon\Carbon::parse($listing->start_time);
        $end = Carbon\Carbon::parse($listing->end_time);
      ?>
      <tr>
        <td class="col-md-4">
          <a href="{{action('ResourceController@show', ['id' => $listing->resource->id])}}">
            {{ $listing->resource->name }}
          </a>
        </td>
        <td class="col-md-1 visible-xs">
          {{ $start->format('F jS Y') }} <BR />
          {{ $start->format('h:i:s A') }} to 
          {{ $end->format('h:i:s A') }}<BR />
          Finished {{ $end->diffForHumans($start) }}
        </td>
        <td class="col-md-3 hidden-xs">
          {{ Carbon\Carbon::parse($listing->start_time)->format('F jS Y - h:i:s A') }}
        </td>
        <td class="col-md-3 hidden-xs">
          {{ $end->format('h:i:s A') }}
        </td>
        @if ($end->gt($now))
          <td class="col-md-2">{{ $listing->status }}</td>
        @else
          <td class="col-md-1 hidden-xs">Finished</td>
        @endif
      </tr>
      @endforeach
    </table>
  </div>
  @endif
</div>
@stop