@extends('layouts.master')

@section('title', 'Log in')

@section('content')

<div class="container">
	<div class="jumbotron">
		<script type="text/javascript">
			function autologin(e) {
				$("#email").val(e);
				$("#password").val('secret');
				$('#form').submit();
			}
		</script>
		<form method="POST" action="/auth/login" id="form">
			{!! csrf_field() !!}
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<h4>Log in failed</h4>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Email">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="Password">
			</div>

			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember">
						Remember me
					</label>
				</div>
			</div>

			<button id="btnLogin" class="btn btn-primary" type="submit">Login</button>

			@if (env('DEBUG_LOGIN', false))
			<hr>

			<h3>Dev tools <small>Auto login</small></h3>
			<p class="text-muted">For testing purposes, these accounts can be logged in by pressing these links.</p>
			<ul>
				@foreach ($users as $user)
				<li>
					<a href="#" onclick="autologin('{{$user->email}}')">{{ $user->name }}</a>
				</li>
				@endforeach
			</ul>
			@endif

			

		</form>
	</div>
</div>

@stop
