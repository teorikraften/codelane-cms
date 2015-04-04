@extends('master')

@section('head-title')
    Visa category: 
    <?php if (isset($token)) { echo $token; } ?>
@stop

@section('head-extra')
    <link rel="stylesheet" type="text/css" href="/styles/catstyle.css">
    <script type="text/javascript">
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

<div class="" id="categories">
	@if (Route::currentRouteName() == 'category-showAll')
		@foreach($categories as $category1)
			<a href="{{ URL::route('category-show', $category1->token) }}" class="btn">{{ $category1->name }}</a>
		@endforeach
	@endif

	@if (Route::currentRouteName() != 'category-showAll')
		@foreach (Category::where('parent', '=', $categories[0]->id)->get() as $child)
			<a href="{{ URL::route('category-show', $child->token) }}" class="btn">{{ $child->name }}</a>
		@endforeach
	@endif
</div>
<div class="clear" id="category-output">
	<h2 id="inline">Sortera efter: 
		<ul class="sortby">
			<li><a href="#">Namn</a></li>
			<li><a href="#">Popularitet</a></li>
			<li class="active"><a href="#">Relevans</a></li>
			<li><a href="#">Senast uppdaterad</a></li>
		</ul>
	</h2>
	<strong>
	Detta är en lista med alla kategorier och under kategorier från head kategorien som defineras i urlen.

	OBS förstå hur listan är uppbyggd innan du försöker använda den. (rekursion krävs). Jag hjälper dig om du säger vad du vill ha.
	<br>
	Lägre ner kommer alla om som ligger i denna kategori eller en underkategori
	<br>
	Author - Johan Jonasson
	<br>
	</strong>
{{-- TODO: Remove duplicates --}}
@foreach ($pms as $pm)
	<a href="{{ URL::route('pm-show', $pm['token']) }}">{{ $pm['title'] }}</a><br>
@endforeach
</div>
    {{ var_dump($category) }}


	
	PM_LISTA

	<?php if (isset($pms)) { var_dump($pms); } ?>

@stop