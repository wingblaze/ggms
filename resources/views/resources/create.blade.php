@extends('layouts.master')

@section('title', 'Create Resource')

@section('content')
<div class="page-header">
	<h1>Add a new facility</h1>
</div>

{!! Form::open(array('action' => 'ResourceController@store')) !!}
  <div class="form-group">
    <label for="name">Name of facility</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <span id="helpBlock" class="help-block">The description will be used to give clients an idea of what they will be renting. 
      Be as descriptive and enticing as possible.</span>
    <textarea id="description" placeholder="" name="description" class="form-control" rows="3"></textarea>
    
  </div>
  <div class="form-group">
    <label for="name">Type of facility</label>
    <span id="helpBlock" class="help-block">To improve reports, use the provided auto-complete suggestions.</span>
    <input type="text" class="form-control" id="type" name="type" placeholder="e.g. sports, venue, golf course">
  </div>
  <hr>
  <p>Note that both of the fields above can be edited afterwards. It is not permanent.</p>
  <button type="submit" class="btn btn-primary">Add new facility</button>
</form>
@stop