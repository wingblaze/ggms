@extends('layouts.master')

@section('title', 'Create A Group')

@section('content')
<div class="page-header">
	<h1>Create A Group</h1>
  @include('partials.error', ['title' => 'Group creation failed'])
</div>

{!! Form::open(array('action' => 'GroupController@store')) !!}

<div class="row">
<h3>Group details</h3>
<div class="form-group form-height-md col-md-6">
  <label for="group">Group name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="">
  <span id="helpBlock" class="help-block">Please input the name of the company or group.</span>
</div>
<div class="form-group form-height-md col-md-6">
  <label for="type">Industry or details</label>
  <select class="form-control" name="type">
    <option value="Agriculture, forestry and fishing">
      Agriculture, forestry and fishing
    </option>
    <option value="Mining and Quarrying">
      Mining and Quarrying
    </option>
    <option value="Manufacturing">
      Manufacturing
    </option>
    <option value="Electricity, gas, steam and air-conditioning supply">
      Electricity, gas, steam and air-conditioning supply
    </option>
    <option value="Water supply, sewerage, waste management and remediation activities">
      Water supply, sewerage, waste management and remediation activities
    </option>
    <option value="Construction">
      Construction
    </option>
    <option value="Wholesale and retail trade; repair of motor vehicles and motorcycles">
      Wholesale and retail trade; repair of motor vehicles and motorcycles
    </option>
    <option value="Transportation and Storage">
      Transportation and Storage
    </option>
    <option value="Accommodation and food service activities">
      Accommodation and food service activities
    </option>
    <option value="Information and Communication">
      Information and Communication
    </option>
    <option value="Financial and insurance activities">
      Financial and insurance activities
    </option>
    <option value="Real estate activities">
      Real estate activities
    </option>
    <option value="Professional, scientific and technical services">
      Professional, scientific and technical services
    </option>
    <option value="Administrative and support service activities">
      Administrative and support service activities
    </option>
    <option value="Public administrative and defense; compulsory social security">
      Public administrative and defense; compulsory social security
    </option>
    <option value="Education">
      Education
    </option>
    <option value="Human health and social work activities">
      Human health and social work activities
    </option>
    <option value="Arts, entertainment and recreation">
      Arts, entertainment and recreation
    </option>
    <option value="Other service activities">
      Other service activities
    </option>
    <option value="Activities of private households as employers and undifferentiated goods and services and producing activities of households for own use">
      Activities of private households as employers and undifferentiated goods and services and producing activities of households for own use
    </option>
    <option value="Activities of extraterritorial organizations and bodies">
      Activities of extraterritorial organizations and bodies
    </option>
  </select>
</div>
</div>
<div class="row">
  <div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" class="form-control" id="description" name="description" placeholder=""></textarea>
    <p class="help-block">Please give a short description of the group.</p>
  </div>
</div>

<div class="row">
<h3>Contact details</h3>
  <div class="form-group form-height-sm col-md-4">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="">
  </div>
  <div class="form-group form-height-sm col-md-4">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
  </div>
  <div class="form-group form-height-sm col-md-4">
    <label for="fax">Fax</label>
    <input type="text" class="form-control" id="fax" name="fax" placeholder="">
  </div>
</div>
<hr>
<button type="submit" class="btn btn-primary">Create a new group</button>
</form>
@stop