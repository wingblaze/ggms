@extends('layouts.master')

@section('title', 'About Us')

@section('content')

<div class="container">
	<div class="jumbotron">
		<h2>An integrated solution</h2>
		<p>The thing about GGMS is that be lorem the ipsum quite effectively in comparison to other foxes and dogs.</p>
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
				
			</div>
		</div>
	</div>
	

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>On-going events</h4>
				
			</div>
		</div>
	</div>
</div>
@stop