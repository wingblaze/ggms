@extends('layouts.master')

@section('title', 'Editing User - ' . $target_user->display_name)

@section('content')
<div class="page-header">
	<h1>Editing user <BR /><small>{{ $target_user->display_name }}</small></h1>
	@include('partials.error', ['title' => 'User update failed'])
</div>

{!! Form::open(array('action' => 'UserController@update_user')) !!}
{!! Form::hidden('user_id', $target_user->id) !!}

<div class="row">
	<div class="form-group form-height-md col-md-4">
		<label for="salutation">Salutation</label>
		<input type="text" class="form-control" id="salutation" name="salutation" placeholder="Sir / Ms. / Mrs." value="{{ $target_user->salutation }}">
	</div>
	<div class="form-group form-height-md col-md-8">
		<label for="name">Full Name</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $target_user->display_name }}">
		<span id="helpBlock" class="help-block">A government ID is required as part of the user's application. Please input the full name exactly as shown on the ID.</span>
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="date">Birth date</label>
		
			
				<div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="birth_date" value="{{ $target_user->birth_date }}"/>
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
		<input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="e.g. Manila" value="{{ $target_user->birth_place }}">
	</div>
	<div class="form-group form-height-sm col-md-4">
		<label for="nationality">Nationality</label>
		<input type="text" class="form-control" id="nationality" name="nationality" placeholder="e.g. Filipino" value="{{ $target_user->nationality }}">
	</div>
</div>
<div class="row">
	<div class="form-group form-height-sm col-md-4">
		<label for="civil_status">Civil status</label>
		<div class="row">
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Single" name="civil_status"
						<?php echo ($target_user->civil_status == 'Single') ? 'checked' : '' ?>
						>
						Single
					</label>
				
			</div>
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Married" name="civil_status"
						<?php echo ($target_user->civil_status == 'Married') ? 'checked' : '' ?>
						>
						Married
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Separated" name="civil_status"
						<?php echo ($target_user->civil_status == 'Separate') ? 'checked' : '' ?>
						>
						Separated
					</label>
			</div>
			<div class="col-md-6">
					<label class="radio-inline">
						<input type="radio" value="Widowed" name="civil_status"
						<?php echo ($target_user->civil_status == 'Widowed') ? 'checked' : '' ?>
						>
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
					<input type="radio" value="Male" name="gender"
					<?php echo ($target_user->gender == 'male') ? 'checked' : '' ?>
					>
					Male
				</label>
			</div>
			<div class="col-md-6">
				<label class="radio-inline">
					<input type="radio" value="Female" name="gender"
					<?php echo ($target_user->gender == 'female') ? 'checked' : '' ?>
					>
					Female
				</label>
			</div>
		</div>
	</div>

</div>
<div class="row">
	<div class="form-group form-height-md col-md-6">
		<label for="email">E-mail</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $target_user->email }}">
		<span id="helpBlock" class="help-block">The e-mail is the secondary way that the client will be contacted when the application is confirmed.</span>
	</div>
	<div class="form-group form-height-md col-md-6">
		<label for="mobile_number">Mobile number</label>
		<input type="mobile_number" class="form-control" id="mobile_number" name="mobile_number" placeholder="e.g. 0917 123 4567" value="{{ $target_user->mobile_number }}">
		<span id="helpBlock" class="help-block">The mobile number is the primary way that the client will be contacted when the application is confirmed.</span>
	</div>
	
	<button type="submit" class="btn btn-primary">Update user</button>
</div>

</form>
@stop
