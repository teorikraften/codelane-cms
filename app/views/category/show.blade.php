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

<div class="" id="currentCat">
	@if (Route::currentRouteName() == 'category-show')
		@foreach($categories as $currentCat)
			@if ($currentCat->parent != 0)
			<a href="{{ URL::route('category-show', Category::find($currentCat->parent)->token)}}" class="btn">{{ $currentCat->name }}</a>
			@else
			<a href="{{ URL::route('category-showAll')}}" class="btn">{{ $currentCat->name }}</a>
			@endif
		@endforeach
	@endif 
</div>
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
	<h2>PM</h2>
	<hr>
	{{-- TODO: Remove duplicates --}}
	@foreach ($pms as $pm)
		<div id="pmListing" onclick="location.href='{{ URL::route('pm-show', $pm['token']) }}';">
			<div id="adriansskit">
			<a href="{{ URL::route('pm-show', $pm['token']) }}">{{ $pm['title'] }}</a>
		</div>
			<div id="pmInfo">
				<b>Författare:</b> {{ $pm['created_by'] }}
				<br>
				<b>Skapad:</b> {{ substr($pm['created_at'], 0, 11) }}
			</div>
			<div id="catDescription">
				{{ substr(trim(strip_tags($pm['content'])), 0, 200) }}...
			</div>
		</div>
	@endforeach
</div>
@stop

<!--
	<strong>
	Detta är en lista med alla kategorier och under kategorier från head kategorien som defineras i urlen.

	OBS förstå hur listan är uppbyggd innan du försöker använda den. (rekursion krävs). Jag hjälper dig om du säger vad du vill ha.
	<br>
	Lägre ner kommer alla om som ligger i denna kategori eller en underkategori
	<br>
	Author - Johan Jonasson
	<br>
	</strong>

     var_dump($category) 


	
	PM_LISTA

	 if (isset($pms)) { var_dump($pms); }
	-->


