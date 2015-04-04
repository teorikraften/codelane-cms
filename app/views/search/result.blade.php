@extends('master')

@section('head-title')
Sökresultat av sökningen: "{{ $searchQuery }}"
@stop

@section('head-extra')
<script type="text/javascript">
$(function() {
	$("#search-query").autocomplete({
		source: '/keywords',
		appendTo: '#search-autocomplete-list'
	});
});
$(function() {
    $(".sortby li").on('click', function() {
    	if(!$(this).hasClass('active')) {
    		$(this).siblings('li').removeClass('active');
    		$(this).addClass('active');
	    }
	});
});
</script>
@stop

@section('body')
{{ Form::open(array('url' => route('post-search'), 'method' => 'post')) }}
<div class="form big-search">
	<div class="search-field">
		{{ Form::text('search-query', $searchQuery, array('class' => 'text', 'placeholder' => 'Sök efter PM...', 'id' => 'search-query')) }}
	</div>
	{{ Form::submit('Sök', array('class' => 'submit')) }}
</div>
{{ Form::close() }}
<div id="search-autocomplete-list"></div>
<div class="clear"></div>

<h1>Sökresultat</h1>
<h2 class="search">Sökning: {{ $searchQuery }}</h2>
<h2 id="inline">Sortera efter: 
	<ul class="sortby">
		<!--{{-- If statements for each sorting method...--}}-->
		@if ($order == 'score')
		<li><a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'alphabetical'))}}">Namn</a></li>
		<li><a href="#">Mest sedda</a></li>
		<li class="active"><a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'score'))}}">Relevans</a></li>
		<li><a href="#">Senast uppdaterad</a></li>
		@else
		<li class="active"><a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'alphabetical'))}}">Namn</a></li>
		<li><a href="#">Mest sedda</a></li>
		<li><a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'score'))}}">Relevans</a></li>
		<li><a href="#">Senast uppdaterad</a></li>
		@endif
	</ul>
</h2>
<ul class="result">
	@foreach($result as $pm)
	<li>
		<h3><a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a></h3>
		<p class="description">{{ substr(trim(strip_tags($pm['pm']->content)), 0, 200) }}...</p>
		{{ $pm['score'] }}
		{{ $pm['operator'] }}
		<?php  /*var_dump($pm['pm']);*/ ?>
	</li>
	@endforeach
</ul>
<div class="search_page_selector">
	<table cellspacing="0" cellpadding="0">
		<tbody>
			<tr>

				<td>
					@if ($page > 1)
					<a href="{{ URL::route('search-result', $searchQuery.'/'. $order .'/'. ($page-1) ) }}">Föregående</a>
					@endif
				</td>
				@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
				<td>
					<a href="{{ URL::route('search-result', $searchQuery.'/'. $order .'/'. ($pageNumber ) )}}"> {{ $pageNumber }} </a>
				</td>
				@endfor
				<td>
					@if ($page < $maxPage)
					<a href="{{ URL::route('search-result', $searchQuery.'/'. $order .'/'. ($page+1) ) }}">Nästa</a>
					@endif
				</td>
			</tr>
		</tbody>
	</table>
</div>
@stop