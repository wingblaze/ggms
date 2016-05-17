@extends('layouts.master')

@section('title', 'Membership Slot')

@section('content')
<div class="page-header">
	<h1>
		View membership slot <small>{{ $slot->type }}</small>
		<div class="pull-right">
			<a class="btn btn-default" href="{{action('MembershipSlotController@edit', $slot->id)}}">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				&nbsp Edit
			</a>
			<a class="btn btn-danger" href="{{action('MembershipSlotController@destroy', $slot->id)}}">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				&nbsp Disable
			</a>
		</div>
	</h1>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-sm">
		<label>Membership slot number</label><BR />
		{{ $slot->id }}
	</div>
	<div class="col-md-8 form-group form-height-sm">
		<label>Description</label><BR />
		{{ $slot->description }}
	</div>
</div>
<div class="row">
	<div class="col-md-4 form-group form-height-xs">
		<label>Date created (Membership slot)</label><BR />
		{!! display_precise_date($slot->created_at) !!}
	</div>
	<div class="col-md-4 form-group form-height-xs">
		<label>Date last updated (Membership slot information)</label><BR />
		{!! display_precise_date($slot->updated_at) !!}
	</div>
</div>
<div class="page-header">
	<h3>Membership slot history</h3>
</div>
@if (count($listings) == 0)
  <div>
    <p>There are currently no club share listings.</p>
  </div>
@else
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th class="col-md-4 hidden-xs">Posted by</th>
      <th class="col-md-4">Taken by</th>
      <th class="col-md-2 hidden-xs">Date club share was posted</th>
      <th class="col-md-2">Date slot taken</th>
    </tr>

    @foreach($listings as $listing)
    <tr>
      <td class="col-md-4 hidden-xs">
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
      <td class="col-md-4">
        @if ($listing->current_account)
          @if ($listing->current_account->owner())
            <a href="{{action('AccountController@show', ['id' => $listing->current_account()->first()->id])}}">
              {{ $listing->current_account->owner()->display_name }}
            </a>
          @else
            No owner
          @endif
        @else
          No owner
        @endif
      </td>
      </td>
      <td class="col-md-2 hidden-xs">
        {!! display_precise_date($listing->created_at) !!}
      </td>
      <td class="col-md-2">
        {!! display_precise_date($listing->updated_at) !!}
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endif
@stop