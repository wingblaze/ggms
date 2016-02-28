@extends('layouts.master')

@section('title', 'Home page')

@section('content')

<div class="container">
	<div class="jumbotron">
		<h2>Generic Golf Management System</h2>
		@if ($user)
			<p>Hi {{ $user->name }}, welcome back!</p>
		@else
			<p>Hello world!</p>
		@endif

		<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
	</div>

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>News</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				 labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
				 nisi ut aliquip ex ea commodo consequat.
				</p>
			</div>
		</div>
	</div>

	
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>New member applications</h4>
				@if ($user)
				<p>As concerned members of our beloved community, please review 
						<a href="{{ action('ComplaintController@index') }}">the new applicants</a>
					 who wish to join our golf community.</p>
					 @endif
				<p>The list below shows a few of the new applicants:</p>
				<UL>
					@foreach ($pending_accounts as $pending_account)
						<LI>{{ $pending_account->owner()->name }}</LI>
					@endforeach
				</UL>
			</div>
		</div>
	</div>
	

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>On-going events</h4>
				<UL>
					<LI>Newbies Golf Tournament, Feb 23</LI>
					<LI>Wedding at Cana, Feb 15</LI>
				</UL>
			</div>
		</div>
	</div>
</div>
@stop