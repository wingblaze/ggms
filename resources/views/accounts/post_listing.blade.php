@extends('layouts.master')

@section('title', 'Post Club Share Listing')

@section('content')
<div class="page-header">
	<h1>Post Club Share Listing</h1>
  <span id="helpBlock" class="help-block">This process allows an account owner to post his club share to a public listing, so that interested parties may purchase it.</span>
</div>
  @if ($user && $user->is_owner())
    @if(!$canPostListing)
    <p>Hello {{ $user->name }}. As account owner, you may 
    <a href="{{ action('AccountController@post_listing') }}" class="btn btn-primary">
      post a club share listing</a> if you wish to no longer be part of this golf course community.
    </p>
    @else
    <span id="helpBlock" class="help-block">
      <em>Note: that you may reverse this process afterwards if you wish to cancel it. The interested party will be given your contact details so that they can contact you.</em>
    </span>
    <p>Hello {{ $user->name }}. As account owner, you may 
    <a href="{{ action('AccountController@remove_listing') }}" class="btn btn-danger">
      remove your club share listing</a> if you changed your mind about selling your club shares.
    </p>
    @endif 
  @else
  @endif
    

@stop