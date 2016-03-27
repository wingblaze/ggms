@extends('layouts.master')

@section('title', 'Club Shares Listing')

@section('content')
<div class="content">
  <h2>My rentals</h2>
  @if (count($listings) == 0)
    <p>You are currently not renting any facilities.</p>
  @else
  <p class="help-block">These are the facilities you are renting.</p>
  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th class="col-md-3">Name of Facility</th>
        <th class="col-md-1">Rental start time</th>
        <th class="col-md-1">Rental end time</th>
        <th class="col-md-1">Status</th>
        <th class="col-md-4">Options</th>
      </tr>
      
      @foreach($listings as $listing)
      <tr>
        <td class="col-md-3">
          <a href="{{action('ResourceController@show', ['id' => $listing->resource->id])}}">
            {{ $listing->resource->name }}
          </a>
           by
           <a href="{{action('UserController@show', ['id' => $listing->user->id])}}">
            {{ $listing->user->display_name }}
          </a>
        </td>
        <td class="col-md-3">{{ Carbon\Carbon::parse($listing->start_time)->format('h:i:s A') }}</td>
        <td class="col-md-3">{{ Carbon\Carbon::parse($listing->end_time)->diffForHumans() }}<BR />
          {{ Carbon\Carbon::parse($listing->end_time)->format('F jS Y, h:i:s A') }}
        </td>
        <td class="col-md-1">{{ $listing->status }}</td>
        <td class="col-md-4">
          @if ($user->hasRole('employee'))
          <a class="btn btn-sm btn-default" href="{{action('ResourceController@edit', ['id' => $listing->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp Edit</a>
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