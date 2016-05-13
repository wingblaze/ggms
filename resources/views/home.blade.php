@extends('layouts.master')

@section('title', 'Home page')

@section('content')

<div class="container">
	<div class="jumbotron">
		<h2>Generic Golf Management System</h2>
		@if ($user)
			<p>Hi {{ trim($user->display_name) }}, welcome back!</p>
		@else
			<p>Welcome!</p>
		@endif
		<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
	</div>

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>What makes GGMS different?</h4>
				<p>
					Produce some abstract, a short paragraph describing how GGMS is different from other golf course management systems.
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
						@if ($pending_account->owner())
							<LI>{{ $pending_account->owner()->display_name }}</LI>
						@endif
					@endforeach
				</UL>
			</div>
		</div>
	</div>
	

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>On-going events</h4>
				@if (count($events) > 0)
					<ul>
						@foreach ($events as $event)
							<li>{{ $event->name }}</li>
						@endforeach
					</ul>
				@else
					<p>No events today. <a href="{{ action('EventController@index') }}">Click here</a> to see more upcoming events.</p>
				@endif
			</div>
		</div>
	</div>
</div>
@stop