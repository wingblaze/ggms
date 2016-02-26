@extends('layouts.master')

@section('title', 'Log in')

@section('content')

<div class="container">
	<div class="jumbotron">
		
		<form method="POST" action="/auth/login">
			{!! csrf_field() !!}

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
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

			<button class="btn btn-primary" type="submit">Login</button>

		</form>
	</div>
</div>

@stop
