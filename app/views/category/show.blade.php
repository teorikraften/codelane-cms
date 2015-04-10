@extends('master')

@section('head-title')
Kategori {{ $category->name or '' }}
@stop

@section('head-extra')
{{ HTML::style('styles/catstyle.css') }}
{{ HTML::script('js/category.js') }}
@stop

@section('body')
<div class="breadcrumb" id="currentCat">
	Du är här: {{ $breadcrumb or '' }} 
</div>

<div class="" id="categories">
	<?php $i = 0; ?>
	@foreach ($children as $child)
	<a href="{{ URL::route('category-show', $child->token) }}" class="btn" style="background: #{{ $color[$i++] }};">
		{{ $child->name }}
	</a>
	@endforeach
</div>

<div class="clear" id="category-output">
	<div id="inline">Sortera efter: 
		<ul class="sortby">
			<li{{ $order == 'alphabetical' ? " class='active'" : '' }} >
			<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => 'alphabetical') )}}">Namn</a></li>
			<li{{ $order == 'view_count' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show-all-sorted', array('token' => $token/* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
			<li{{ $order == 'score' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => 'score') )}}">Relevans</a></li>
			<li{{ $order == 'revision_date' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show-all-sorted', array('token' => $token/* TODO , 'order' => 'revision_date' */) )}}">Senast uppdaterad</a>
		</ul>
	</div>
	<h2>PM</h2>
	<hr>

	@foreach ($pms as $pm)
	@if (isset($pm['roles']))
	@foreach ($pm['roles'] as $key => $role)
	{{ "'" . $role->name . "'är en role till pm nedan" }}
	@endforeach
	@endif


	<div id="pmListing" onclick="location.href='{{ URL::route('pm-show', $pm['pm']->token) }}';">

		<div id="adriansskit">
			<a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a>
		</div>
		<div id="pmInfo">
			<b>Författare:</b> 
			@foreach ($pm['pm']->users as $role) 
			@if ($role->pivot->assignment == 'author')
			{{ $role->real_name }}
			@endif
			@endforeach
			<br>
			<b>Skapad:</b> {{ substr($pm['pm']->created_at, 0, 11) }}
		</div>
		<div id="catDescription">
			{{ substr(trim(strip_tags($pm['pm']->content)), 0, 200) }}...
		</div>
	</div>
	@endforeach
</div>
@stop

