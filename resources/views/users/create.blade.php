@extends('layouts.master')

@section('title', 'Register User')

@section('content')
<div class="page-header">
	<h1>Register a new user</h1>
	<p>This process allows you to add a new user, whether a membership holder or a dependent, to a defined account.</p>
	@include('partials.error', ['title' => 'User creation failed'])
</div>

{!! Form::open(array('action' => 'UserController@store')) !!}

<div class="row">
<h3>Personal details</h3>
	<div class="form-group form-height-md col-md-4">
		<label for="salutation">Salutation</label>
		<input type="text" class="form-control" id="salutation" name="salutation" placeholder="Sir / Ms. / Mrs.">
	</div>
	<div class="form-group form-height-md col-md-8">
		<label for="name">Full Name</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="">
		<span id="helpBlock" class="help-block">A government ID will be required as part of the user's application. Please input the full name exactly as shown on the ID.</span>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="date">Birth date</label>
		
			
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control" name="birth_date" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
			
			<script type="text/javascript">
			$(function () {
				$('#datetimepicker1').datetimepicker({
					format: 'YYYY-MM-DD'
				});
			});
			</script>
		
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="birth_place">Birth place</label>
		<input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="nationality">Nationality</label>
		<input type="text" class="form-control" id="nationality" name="nationality" placeholder="e.g. Filipino">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="civil_status">Civil Status</label>
		<div class="row">
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Single" name="civil_status">
						Single
					</label>
				
			</div>
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Married" name="civil_status">
						Married
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Separated" name="civil_status">
						Separat
					</label>ed
			</div>
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Widowed" name="civil_status">
						Widowed
					</label>
			</div>
		</div>
	</div>

	<div class="form-group form-height-sm col-md-4">
		<label for="gender">Gender</label>
		<div class="row">
			<div class="col-md-6">
				<label class="radio-inline">
					<input type="radio" value="Male" name="gender">
					Male
				</label>
			</div>
			<div class="col-md-6">
				<label class="radio-inline">
					<input type="radio" value="Female" name="gender">
					Female
				</label>
			</div>
		</div>
	</div>

</div>


<hr />

<div class="row">
	<h3>Contact details</h3>
	<div class="form-group form-height-md col-md-6">
		<label for="mobile_number">Mobile Number</label>
		<input type="mobile_number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
		<span id="helpBlock" class="help-block">The mobile number is the primary way that the client will be contacted when the application is confirmed.</span>
	</div>
	<div class="form-group form-height-md col-md-6">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email">
		<span id="helpBlock" class="help-block">The e-mail is the secondary way that the client will be contacted when the application is confirmed.</span>
	</div>
</div>

<hr />
<h3>Access details</h3>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="user_type">User type</label><BR />
			<div class="row">
				<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="user" name="user_type" checked>User
					</label>
				</div>
				<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="employee" name="user_type">Employee
					</label>
				</div>
			</div>
		<span id="helpBlock" class="help-block">Is this a new member of the golf course or an employee?</span>
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="passwordRepeat">Confirm password</label>
		<input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Password">
	</div>
		
</div>

<hr>
<p>The application process lasts for two (2) weeks as the members of the community review the requested application. The client will be contacted 
	within this period to inform them of their application's status.</p>
	<button type="submit" class="btn btn-primary">Create user</button>
</form>
@stop