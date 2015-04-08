@extends('master')

@section('head-title')
    Favoriter
@stop

@section('head-extra')

@stop

@section('body')

    @foreach($pms as $key => $pm)
        
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