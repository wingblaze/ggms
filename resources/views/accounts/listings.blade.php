<?PHP
$user = Auth::user();
?>

@extends('layouts.master')

@section('title', 'Club Shares Listing')

@section('content')
<div class="page-header">
  <h1>Club Shares Listing</h1>
  <span id="helpBlock" class="help-block">Here is a list of club shares that account owners have posted to sell.</span>
  
  @if ($user && $user->is_owner())
    <h3>Post a listing</h3>
    Hello {{ $user->name }}. As account owner, you may 
    <a href="{{ action('AccountController@post_listing') }}">
      post a club share listing
    </a> to sell your club shares.
  @endif

  
</div>

<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th class="col-md-2">Account owner</th>
      <th class="col-md-2">Golf membership type</th>
    </tr>

    @foreach($listings as $listing)
    <tr>
      <td class="col-md-2">
        @if ($listing->account())
          <a href="{{action('AccountController@show', ['id' => $listing->account()->first()->id])}}">
            {{ $listing->account()->first()->owner()->name }}
          </a>
        @else
          No owner
        @endif
      </td>
      <td class="col-md-2">
        {{ $listing->slot['type'] }}
      </td>
    </tr>
    @endforeach
  </table>
</div>
@stop