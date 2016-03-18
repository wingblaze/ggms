@extends('layouts.master')

@section('title', 'Facilities List')

@section('content')
<div class="page-header">
  <h1>Unpaid rentals</h1>
</div>
<div class="content">
  @if (count($listings) == 0)
    <p>There are no unpaid facilities.</p>
  @else
  <p class="help-block">These are the facilities being rented that have not yet been paid.</p>
  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th class="col-md-3">Name of Facility and Renter</th>
        <th class="col-md-1">Rental start time</th>
        <th class="col-md-1">Rental end time</th>
        <th class="col-md-1">Status</th>
        <th class="col-md-4">Options</th>
      </tr>
      
      @foreach($listings as $listing)
      <tr>
        <td class="col-md-3">
          <a href="{{action('ResourceController@show', ['id' => $listing->resource->id])}}">
            {{ $listing->resource->name}}
          </a>
           by
           <a href="{{action('UserController@show', ['id' => $listing->user->id])}}">
            {{ $listing->user->display_name }}
          </a>
        </td>
        <td class="col-md-3">{{ Carbon\Carbon::parse($listing->start_time)->diffForHumans() }}<BR />
          {{ Carbon\Carbon::parse($listing->start_time)->format('F jS Y, h:i:s A') }}
        </td>
        <td class="col-md-3">{{ Carbon\Carbon::parse($listing->end_time)->diffForHumans() }}<BR />
          {{ Carbon\Carbon::parse($listing->end_time)->format('F jS Y, h:i:s A') }}
        </td>
        <td class="col-md-1">{{ $listing->status }}</td>
        <td class="col-md-4">
          @if ($user->hasRole('employee'))
          <a class="btn btn-sm btn-default" href="{{ action('ResourceController@paid_listing', $listing->id) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Paid</a>
          @else
            None
          @endif
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  @endif
</div>
@stop