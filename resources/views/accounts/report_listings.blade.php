@extends('layouts.master')

@section('title', 'Club Shares Report')

@section('content')
<div class="page-header">
  <h1>Club Shares Reports</h1>
  <span id="helpBlock" class="help-block">Here is a list of club shares that account owners have posted to sell.</span>
  
</div>

<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th class="col-md-2">Account owner</th>
      <th class="col-md-2">Golf membership type</th>
      <th class="col-md-2">Date created / listed</th>
      <th class="col-md-2">Date updated</th>
    </tr>

    @foreach($listings as $listing)
    <?PHP
      $isForSale = isset($listing->membership_slot['type']) == false; 
      if ($isForSale)
      {
        $reference = App\MembershipControl::where('account_id', $listing->account_id)->whereNotNull('membership_slot_id')->first();
      }

    ?>
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

        {{ $listing->membership_slot['type'] or "Sale (" . $reference->membership_slot['type'] . ")" }}
      </td>
      <td class="col-md-2">
        {{ $listing->created_at or '-' }}
      </td>
      <td class="col-md-2">
        @if (isset($listing->membership_slot['type']) == false)
          Not yet taken
        @else
          {{ $listing->udpated_at or '-' }}
        @endif
      </td>
    </tr>
    @endforeach
  </table>
</div>
@stop