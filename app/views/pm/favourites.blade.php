@extends('master')

@section('head-title')
Favoriter
@stop

@section('head-extra')

@stop

@section('body')

@include('includes.messages')

@if($s = Session::get('successfav'))
	<p class="pop success">
			{{ $s['message'] }} <a href="{{ URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $s['token'])) }}" >Undo</a>
		</p>
@endif

@foreach($pms as $key => $pm)
<a href="{{ URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $pm->token)) }}" title="Favorit" class="goldenstar">&#9733</a>

{{ Form::model($pm, array('action' => 'post-favourite-edit', 'method' => 'post'))}}
{{ Form::hidden('token') }}
{{ Form::hidden('goto', 'fav')}}
{{ Form::submit('&#9733', array('class' => 'goldenstar'))}}

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