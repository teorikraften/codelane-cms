@extends('master')

@section('head-title')
	Favoriter
@stop

@section('body')

@include('includes.messages')

@foreach($pms as $key => $pm)
<a href="{{ URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $pm->token)) }}" title="Favorit" class="goldenstar">&#9733;</a>

<div id="pmListing">

	<div id="pmTitle">
		<a href="{{ URL::route('pm-show', $pm->token) }}">{{ $pm->title }}</a>
	</div>
	<div id="pmInfo">
		<b>Författare:</b> 
		@foreach ($pm->users as $role) 
		@if ($role->pivot->assignment == 'author')
		{{ $role->real_name }}
		@endif
		@endforeach
		<br>
		<b>Skapad:</b> {{ substr($pm->created_at, 0, 11) }}

	</div>
	<div id="catDescription">
		{{ substr(trim(strip_tags($pm->content)), 0, 200) }}...
	</div>
</div>
@endforeach
@stop