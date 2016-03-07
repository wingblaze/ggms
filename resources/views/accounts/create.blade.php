@extends('layouts.master')

@section('title', 'Create An Account')

@section('header')
@parent
<script src="/js/bootstrap3-typeahead.min.js"></script>
@endsection

@section('content')
<div class="page-header">
	<h1>Create An Account</h1>
  <span id="helpBlock" class="help-block">This process allows you to create a new membership account, which will be for review.</span>
  @include('partials.error', ['title' => 'Account creation failed'])
</div>

{!! Form::open(array('action' => 'AccountController@store')) !!}
  <h3>Account details</h3>
  <div class="form-group">
    <label for="group_name">Company </label>
    <span id="helpBlock" class="help-block">Please input the name of the company this application is involved with.
      <strong>If the company does not exist yet, please create the company first before creating the account.</strong></span>
    <input type="text" class="form-control" id="group_name" name="group" placeholder="Name of Group" data-provide="typeahead" autocomplete="off">
  </div> 
  <div class="form-group">
    <label for="date">Membership Expiration date</label>
    <div class="row">
      <div class='col-sm-6'>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" name="expiration" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      $(function () {
        $('#datetimepicker1').datetimepicker({
          format: 'YYYY-MM-DD'
        });
      });
      </script>
    </div>
  </div>
  <h3>Contact details</h3>
  <span id="helpBlock" class="help-block">Your contact details allow us to contact you in case of issues with your account, or to confirm your referrals.</span>
  <div class="form-group">
    <label for="phone">Phone number</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
  </div>
  <div class="form-group">
    <label for="fax">Fax</label>
    <input type="text" class="form-control" id="fax" name="fax" placeholder="">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="">
  </div>
  <h3>Personal details</h3>
  <span id="helpBlock" class="help-block">The personal details you provide below allow us to understand our clients better.</span>
  <div class="form-group">
    <label for="owner">TIN Number</label>
    <input type="text" class="form-control" id="tin_number" name="tin_number" placeholder="e.g. 192834857">
  </div>
  <div class="form-group">
    <label for="owner">Home Address</label>
    <input type="text" class="form-control" id="home_address" name="home_address" placeholder="">
  </div>
  <div class="form-group">
    <label for="owner">Business Address</label>
    <input type="text" class="form-control" id="business_address" name="business_address" placeholder="">
  </div>
  <div class="form-group">
    <label for="owner">Residency Certificate</label>
    <input type="text" class="form-control" id="residence_certificate_id" name="residence_certificate_id" placeholder="e.g. 1010234">
  </div>
  <div class="form-group">
    <label for="owner">Place issued</label>
    <input type="text" class="form-control" id="residence_certificate_place_issued" name="residence_certificate_place_issued" placeholder="e.g. Makati">
  </div>
  <div class="form-group">
    <label for="date">Date issued</label>
    <div class="row">
      <div class='col-sm-6'>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" name="residence_certificate_date_issued" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      $(function () {
        $('#datetimepicker2').datetimepicker({
          format: 'YYYY-MM-DD'
        });
      });
      </script>
    </div>
  </div>
  <hr />
  <h3>Payment details</h3>
  <span id="helpBlock" class="help-block">You can specify your payment details below.</span>
  <div class="form-group">
    <label for="owner">Bank Account Number</label>
    <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="e.g. 293847561">
  </div>
  <div class="form-group">
    <label for="owner">Credit Card Number</label>
    <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="e.g. 5837 3947 1938 1923">
  </div>
  <hr>
  <h3>Membership details</h3>
  <span id="helpBlock" class="help-block">You can specify which membership slot this account will have.</span>
  <div class="form-group">
    <label for="membership_slot">Membership Slot</label>
    <select class="form-control" name="membership_slot">
      <option value="-1">No slot assigned</option>
      @foreach ($slots as $slot)
        <option value="{{ $slot->id }}">Slot {{$slot->id}} - {{ $slot->type}} </option>
      @endforeach
    </select>
  </div>
  <hr>
  <span id="helpBlock" class="help-block">The application process lasts for two (2) weeks as the members of the community review the requested application. The client will be contacted 
  	within this period to inform them of their application's status.</span>
  <button type="submit" class="btn btn-primary">Apply</button>
{!! Form::close() !!}

<script type="text/javascript">
  $.get('/groups.json', function(data){
    $("#group_name").typeahead({ source:data });
  },'json');
</script>
@stop