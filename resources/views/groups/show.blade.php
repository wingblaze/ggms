@extends('layouts.master')

@section('title', 'View Group')

@section('content')
<div class="page-header">
	<h1>View group <small>{{ $group->name }}</small></h1>
</div>
<p><label>Description</label><BR />
	{{ $group->description }}
</p>
<hr>
<p><label>address</label><BR />
	{{ $group->address }}
</p>
<hr>
<p><label>type</label><BR />
	{{ $group->type }}
</p>
<hr>
<p><label>phone</label><BR />
	{{ $group->phone }}
</p>
<hr>
<p><label>fax</label><BR />
	{{ $group->fax }}
</p>
<hr>
<p><label>created_at</label><BR />
	{{ $group->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $group->updated_at }}
</p>
<hr>
@stop