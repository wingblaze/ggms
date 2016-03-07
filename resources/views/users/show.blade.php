@extends('layouts.master')

@section('title', 'User Profile')

@section('content')
<div class="page-header">
	<h1>View user <small>{{ $target_user->salutation or '' }} {{ $target_user->name }}</small></h1>
</div>
<p><label>E-mail</label><BR />
	{{ $target_user->email }}
</p>
<hr>
<p><label>mobile_number</label><BR />
	{{ $target_user->mobile_number }}
</p>
<hr>
<p><label>birth_date</label><BR />
	{{ $target_user->birth_date }}
</p>
<hr>
<p><label>birth_place</label><BR />
	{{ $target_user->birth_place }}
</p>
<hr>
<p><label>nationality</label><BR />
	{{ $target_user->nationality }}
</p>
<hr>
<p><label>gender</label><BR />
	{{ $target_user->gender }}
</p>
<hr>
<p><label>civil_status</label><BR />
	{{ $target_user->civil_status }}
</p>
<hr>
@if ($target_user->account_type != NULL)
<p><label>account_type</label><BR />
	{{ $target_user->account_type }}
</p>
<hr>
@endif
<p><label>created_at</label><BR />
	{{ $target_user->created_at }}
</p>
<hr>
<p><label>updated_at</label><BR />
	{{ $target_user->updated_at }}
</p>
<hr>
@stop