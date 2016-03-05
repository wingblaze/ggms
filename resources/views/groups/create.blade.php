@extends('layouts.master')

@section('title', 'Create A Group')

@section('content')
<div class="page-header">
	<h1>Create A Group</h1>
  @include('partials.error', ['title' => 'Group creation failed'])
</div>

{!! Form::open(array('action' => 'GroupController@store')) !!}
  <div class="form-group">
    <label for="group">Group name</label>
    <span id="helpBlock" class="help-block">Please input the name of the company or group.</span>
    <input type="text" class="form-control" id="name" name="name" placeholder="">
  </div>
  <div class="form-group">
    <label for="type">Group type</label>
    <span id="helpBlock" class="help-block">As much as possible, choose from the provided auto-complete selection.</span>
    <input type="text" class="form-control" id="type" name="type" placeholder="">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" class="form-control" id="description" name="description" placeholder=""></textarea>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
  </div>
  <div class="form-group">
    <label for="fax">Fax</label>
    <input type="text" class="form-control" id="fax" name="fax" placeholder="">
  </div>
  <hr>
  <button type="submit" class="btn btn-primary">Create a new group</button>
</form>
@stop