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

	<div class="result" style="margin-top: 30px">Sökresultat
		<ul class="sortby">
			<li <?php if ($order == 'score') echo "class='active'"?> >
				<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'score'))}}">
					Relevans
				</a>
			</li>
			<li <?php if ($order == 'alphabetical') echo "class='active'"?> >
				<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'alphabetical'))}}">
					Namn
				</a>
			</li>
			<!--
			<li <?php if ($order == 'view_count') echo "class='active'"?> >
				<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, /* TODO  'order' => 'view_count' */))}}">
					Mest sedda
				</a>
			</li>
		-->
			<li <?php if ($order == 'revision_date') echo "class='active'"?> >
				<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => 'revision_date'))}}">
					Senast uppdaterad
				</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>

	<ul class="result">
		@foreach($result as $pm)
			<li>
				<h3>
					<a href="{{ URL::route('get-favourite-edit', array('goto' => 'resultat', 'token' => $pm['pm']->token)) }}" title="Favoritmarkera" class="{{ $pm['pm']->favouriteByUser() ? 'goldenstar' : 'greystar' }} small" >
        				{{ $pm['pm']->favouriteByUser() ? '&#9733;' : '&#9734;' }}
    				</a>
        			<a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a>
        		</h3>
				@if(count($pm['pm']->tags) > 0)
					<div class="tags">
						<b>Taggar:</b>
						@foreach($pm['pm']->tags as $tag)
							<a href="{{ URL::route('tag-show', $tag->token) }}">{{ $tag->name }}</a>
						@endforeach
						<div class="clear"></div>
					</div>
				@endif
				<p class="description">{{ substr(trim(strip_tags($pm['pm']->content)), 0, 200) }}...</p>
			</li>
		@endforeach
	</ul>

	<div class="pagination">
		<ul class="pagination">
			@if($page > 1)
				<li>
					<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => $order, 'page' => ($page-1) ) ) }}">
						Föregående
					</a>
				</li>
			@endif
			@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
				@if($page == $pageNumber)
					<li class="active">
						<span>{{ $pageNumber }}</span>
					</li>
				@else
					<li class="active">
						<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => $order , 'page' => $pageNumber ) )}}">
							{{ $pageNumber }}
						</a>
					</li>
				@endif
			@endfor
			@if($page < $maxPage)
				<li>
					<a href="{{ URL::route('search-result', array('searchQuery' => $searchQuery, 'order' => $order , 'page' => ($page+1) ) ) }}">Nästa</a>
				</li>
			@endif
		</ul>
	</div>
@stop