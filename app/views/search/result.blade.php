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
	<ul class="result">
	    @foreach($result as $pm)
		    <li>
		    	<h3><a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a></h3>
		      	<p class="description">{{ substr(trim(strip_tags($pm['pm']->content)), 0, 200) }}...</p>
		  		{{ $pm['score'] }}
		  		{{ $pm['tag'] }}
		  		<?php  /*var_dump($pm['pm']);*/ ?>
		  	</li>
	  	@endforeach
	</ul>
	<div id="search_page_selector">
		<table>
			<tr>
				<td>
					<a href="">Föregående</a>
				</td>
				<td>
					<a href="">Nästa</a>
				</td>
			</tr>
		</table>
	</div>
@stop