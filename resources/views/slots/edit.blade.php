@extends('layouts.master')

@section('title', 'Editing Membership Slot')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>{{ $slot->type}} <small>Membership Slot {{ $slot->id}} </small></h1>
  @include('partials.error', ['title' => 'Membership slot update failed'])
</div>
{!! Form::open(array('action' => 'MembershipSlotController@update_slot')) !!}
  {!! Form::hidden('slot_id', $slot->id) !!}
  <div class="form-group">
    <label for="type">Slot type</label>
    <p class="help-block">This is the human readable title of this slot. (e.g. Co-owner, patron, standard member, premium member, etc.)</p>
    <input class="form-control" id="type" type="text" name="type" value="{{ $slot->type }}" placeholder="Membership slot type">
  </div>

  <div class="form-group">
    <label for="description">Slot description</label>
    <p class="help-block">A brief description about this slot. Use this to give the users an idea of what are the benefits of this kind of membership slot.</p>
    <textarea type="text" class="form-control" id="description" name="description" placeholder="" rows="4">{{ $slot->description }}</textarea>
  </div>
  
  <div class="form-group">
    <label for="description">Slot owned by</label>
    <p class="help-block">Who currently holds this membership slot? If this field is left blank, then the slot will be unassigned.</p>
    @if ($control->owner())
	    <input type="text" class="form-control" id="user" name="user" placeholder="Name of user" data-provide="typeahead" autocomplete="off" value="{{ $control->owner()->name }}">
    @else
      <input type="text" class="form-control" id="user" name="user" placeholder="Name of user" data-provide="typeahead" autocomplete="off">
    @endif
  </div>
  
  <hr>
  <button type="submit" class="btn btn-primary">Update membership slot</button>
{!! Form::close() !!}

<script type="text/javascript">
  $.get('/users.json', function(data){
    $("#user").typeahead({ source:data });
  },'json');
</script>
@stop