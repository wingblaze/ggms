@extends('layouts.master')

@section('title', 'View Resource')

@section('content')
<div class="page-header">
	<h1>View facility <small>{{ $resource->name }}</small></h1>
</div>
<p><label>Description</label><BR />
	{{ $resource->description }}
</p>
<hr>
<p><label>type</label><BR />
	{{ $resource->type }}
</p>
<hr>
<p><label>created_at</label><BR />
	{{ $resource->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $resource->updated_at }}
</p>
<hr>
@stop