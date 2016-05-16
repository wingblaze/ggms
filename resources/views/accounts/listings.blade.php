@extends('layouts.master')

@section('title', 'Club Shares Listing')

@section('content')
<div class="page-header">
  <h1>Club Shares Listing</h1>
  <span id="helpBlock" class="help-block">Here is a list of club shares that account owners have posted to sell.</span>
  @include('partials.error', ['title' => 'Club Share Listing failed'])
  
  @if ($user && $user->is_owner() && $user->hasRole('user') && $user->hasRole('employee') == false)
    
    @if (!$canPostListing)
      <h3>Post a listing</h3>
      Hello {{ $user->display_name }}. You currently have a club share listing posted. As account owner, you may 
      <a href="{{ action('AccountController@remove_listing') }}" class="btn btn-danger">
      remove your club share listing</a> if you changed your mind about selling your club shares.
    @else
      <h3>Post a listing</h3>
      Hello {{ $user->display_name }}. As account owner, you may 
      <a href="{{ action('AccountController@post_listing') }}" class="btn btn-primary">
      post a club share listing</a> if you wish to sell your membership slot.
    @endif
  @endif
</div>

@if (count($listings) == 0)
  <div>
    <p>There are currently no club share listings.</p>
  </div>
@else
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th class="col-md-2">Club share listing posted by</th>
      <th class="col-md-2">Golf membership type</th>
      <th class="col-md-2">Date posted</th>
    </tr>

    @foreach($listings as $listing)
    <tr>
      <td class="col-md-2">
        @if ($listing->posted_by_account)
          @if ($listing->posted_by_account->owner())
            <a href="{{action('AccountController@show', ['id' => $listing->posted_by_account()->first()->id])}}">
              {{ $listing->posted_by_account->owner()->display_name }}
            </a>
          @else
            No owner
          @endif
        @else
          No owner
        @endif
      </td>
      <td class="col-md-2">
      @if ($listing && $listing->posted_by_account && $listing->posted_by_account->current_membership_slot())
        {{ $listing->posted_by_account->current_membership_slot()['type'] }}
      @endif
      </td>
      <td class="col-md-2">
        {!! display_readable_date($listing->created_at) !!}
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endif
@stop