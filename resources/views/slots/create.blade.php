@extends('layouts.master')

@section('title', 'Register User')

@section('content')
<div class="page-header">
	<h1>Register a new user</h1>
	<p>This process allows you to create new membership slots as necessary.</p>
	@include('partials.error', ['title' => 'Membership slot creation failed'])
</div>

{!! Form::open(array('action' => 'UserController@store')) !!}
<h3>Personal details</h3>
<div class="form-group">
	<label for="salutation">Salutation</label>
	<input type="text" class="form-control" id="salutation" name="salutation" placeholder="Sir / Ms. / Mrs.">
</div>
<div class="form-group">
	<label for="name">Full Name</label>
	<input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
	<span id="helpBlock" class="help-block">Please input the full name as shown on the valid ID.</span>
</div>
<div class="form-group">
	<label for="date">Member birth date</label>
	<div class="row">
		<div class='col-sm-6'>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="birth_date" />
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
<div class="form-group">
	<label for="birth_place">Birth place</label>
	<input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="">
</div>
<div class="form-group">
	<label for="nationality">Nationality</label>
	<input type="text" class="form-control" id="nationality" name="nationality" placeholder="e.g. Filipino">
</div>

<div class="form-group">
	<label for="civil_status">Civil Status</label>
	<input type="text" class="form-control" id="civil_status" name="civil_status" placeholder="e.g. Single, Married">
</div>

<div class="form-group">
	<label for="gender">Gender</label>
	<div class="container">
		<div class="col-md-2">
			<label>
				Male
				<input type="radio" class="form-control" value="Male" name="gender">
			</label>
		</div>
		<div class="col-md-2">

			<label>
				Female
				<input type="radio" class="form-control" value="Female" name="gender">
			</label>
		</div>
	</div>
</div>

<hr />
<h3>Contact details</h3>
<div class="form-group">
	<label for="mobile_number">Mobile Number</label>
	<input type="mobile_number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
	<span id="helpBlock" class="help-block">The mobile number is the primary way that the client will be contacted when the application is confirmed.</span>
</div>
<div class="form-group">
	<label for="email">Email</label>
	<input type="email" class="form-control" id="email" name="email" placeholder="Email">
	<span id="helpBlock" class="help-block">Your e-mail is the secondary way that the client will be contacted when the application is confirmed.</span>
</div>

<hr />
<h3>Access details</h3>
<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
</div>
<div class="form-group">
	<label for="passwordRepeat">Repeat password</label>
	<input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Password">
</div>
<hr>
<div class="form-group">
	<label for="user_type">User type</label>
	<span id="helpBlock" class="help-block">Is this a new user or an employee?</span>
	<div class="container">
		<div class="col-md-2">
			<label>
				User
				<input type="radio" class="form-control" value="user" name="user_type" checked>
			</label>
		</div>
		<div class="col-md-2">

			<label>
				Employee
				<input type="radio" class="form-control" value="employee" name="user_type">
			</label>
		</div>
	</div>
</div>
<hr>
<p>The application process lasts for two (2) weeks as the members of the community review the requested application. The client will be contacted 
	within this period to inform them of their application's status.</p>
	<button type="submit" class="btn btn-primary">Create user</button>
</form>
@stop