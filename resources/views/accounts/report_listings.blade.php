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
      <th class="col-md-2">Posted by</th>
      <th class="col-md-2">Current slot holder</th>
      <th class="col-md-2">Golf membership type</th>
      <th class="col-md-2">Date created / listed</th>
      <th class="col-md-2">Date updated</th>
    </tr>

    @foreach($listings as $listing)
    <?PHP
      $isForSale = isset($listing->membership_slot['type']) == false; 
      if ($isForSale)
      {
        $reference = App\MembershipControl::where('current_account_id', $listing->posted_by_account_id)->whereNotNull('membership_slot_id')->first();
      }
    ?>
    <tr>
      <td class="col-md-2">
        @if ($listing->posted_by_account)
          <a href="{{action('AccountController@show', ['id' => $listing->posted_by_account()->first()->id])}}">
            {{ $listing->posted_by_account()->first()->owner()->name or '-' }}
          </a>
        @else
          No poster
        @endif
      </td>
      <td class="col-md-2">
        @if ($listing->current_account)
          <a href="{{action('AccountController@show', ['id' => $listing->current_account()->first()->id])}}">
            {{ $listing->current_account()->first()->owner()->name or '-' }}
          </a>
        @else
          No owner
        @endif
      </td>
      <td class="col-md-2">
        @if ($listing->membership_slot['type'])
          <?PHP $slot_id = $listing->membership_slot['id']; ?>
          (Slot {{ $slot_id or '-' }}) - {{ $listing->membership_slot['type'] or '-' }} 
        @else
          
          (Slot {{ $slot_id or '-' }}) - {{ $reference->membership_slot['type'] or '-' }} <br />
          <em>On sale</em>
        @endif
      </td>
      <td class="col-md-2">
        {{ $listing->created_at or '-' }} 
      </td>
      <td class="col-md-2">
        @if (isset($listing->membership_slot['type']) == false)
          Not yet taken
        @else
          {{ $listing->updated_at or '-' }}
        @endif
      </td>
    </tr>
    @endforeach
  </table>
</div>
@stop