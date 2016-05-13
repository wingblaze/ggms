@extends('layouts.master')

@section('title', 'Assign User')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Assign User to an Account</h1>
</div>

{!! Form::open(array('action' => 'AccountController@assign_user')) !!}
<div class="row">
  <div class="form-group form-height-xs col-md-4">
    <label>Current account owner</label>
    <p>{{ $account->owner()->display_name }}</p>
  </div>
  <div class="form-group form-height-xs col-md-8">
    <label>Account members</label>
    <p>
      <?php 
        $arr = array(); $i = 0;
        foreach ($account->users as $user) {
          $arr[$i] = $user->display_name; $i++;
        }
        echo smart_enumerate($arr);
       ?>
    </p>
  </div>

</div>
<div class="row">
  <div class="form-group form-height-sm col-md-6">
    <label for="user_name">User name</label>
    <input type="text" class="form-control" id="user_name" name="user" placeholder="" data-provide="typeahead" autocomplete="off" required>
  </div> 
<div class="form-group form-height-sm col-md-6">
  <label>Account ownership</label>
  <div class="checkbox">
    <label><input type="checkbox" name="owner">Yes, assign this user as the account owner.</label>
  </div>
</div>
<input type="hidden" name="id" value="{{ $account_id }}"/>
<button type="submit" class="btn btn-primary">Assign User</button>
<a class="btn btn-default" href="{{ action('AccountController@show', $account_id) }}">Cancel</a>
</div>
  

{!! Form::close() !!}

<script type="text/javascript">
  $.get('/users.json', function(data){
    $("#user_name").typeahead({ source:data });
  },'json');
</script>
@stop