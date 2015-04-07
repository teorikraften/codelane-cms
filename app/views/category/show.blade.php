@extends('master')

@section('head-title')
Kategori {{ $category or '' }}
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
	<div id="inline">
		@if (isset($token))
		<ul class="sortby">
			<li{{ $order == 'alphabetical' ? " class='active'" : '' }} >
			<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'alphabetical') )}}">Namn</a></li>
			<li{{ $order == 'view_count' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show', array('token' => $token/* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
			<li{{ $order == 'score' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'score') )}}">Relevans</a></li>
			<li{{ $order == 'revision_date' ? " class='active'" : '' }}>
			<a href="{{ URL::route('category-show', array('token' => $token/* TODO , 'order' => 'revision_date' */) )}}">Senast uppdaterad</a>
		</ul>
		@else
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
		@endif
	</div>
	<h2>PM</h2>
	<hr>

	@foreach ($pms as $pm)
	<div id="pmListing">

		<div id="pmTitle">
			<a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a>
			<div id="roleRel">
				@if (isset($pm['roles']))
					<?php $roles = 'Detta PM är relevant till en eller flera av dina roller: '; ?>
					@foreach ($pm['roles'] as $key => $role)
						<?php $roles = $roles . $role->name ?>
					@endforeach
					{{ HTML::image('images/persons.png', $roles, array('title' => $roles)) }} 
				@endif
			</div>
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
<div class="search_page_selector">
	<table cellspacing="0" cellpadding="0">
		@if (isset($token))
		<tbody>
			<tr>
				<td>
					@if ($page > 1)
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => $order, 'page' => ($page-1) ) ) }}">Föregående</a>
					@endif
				</td>
				@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
				<td>
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => $order , 'page' => $pageNumber ) )}}"> {{ $pageNumber }} </a>
				</td>
				@endfor
				<td>
					@if ($page < $maxPage)
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => $order , 'page' => ($page+1) ) ) }}">Nästa</a>
					@endif
				</td>
			</tr>
		</tbody>
		@else
		<tbody>
			<tr>
				<td>
					@if ($page > 1)
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order, 'page' => ($page-1) ) ) }}">Föregående</a>
					@endif
				</td>
				@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
				<td>
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order , 'page' => $pageNumber ) )}}"> {{ $pageNumber }} </a>
				</td>
				@endfor
				<td>
					@if ($page < $maxPage)
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order , 'page' => ($page+1) ) ) }}">Nästa</a>
					@endif
				</td>
			</tr>
		</tbody>
		@endif
	</table>
</div>
@stop

