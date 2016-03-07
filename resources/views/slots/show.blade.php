@extends('layouts.master')

@section('title', 'Membership Slot')

@section('content')
<div class="page-header">
	<h1>View membership slot <small>{{ $slot->type }}</small></h1>
</div>
<p><label>ID</label><BR />
	{{ $slot->id }}
</p>
<hr>
<p><label>Description</label><BR />
	{{ $slot->description }}
</p>
<hr>
<p><label>created_at</label><BR />
	{{ $slot->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $slot->updated_at }}
</p>
<hr>
@stop