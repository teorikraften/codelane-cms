@extends('master')

@section('head-title')
    Visa kategori: @if (isset($token)) {{ $categories[0]->name}} @endif 

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


			<a href="{{ URL::route('category-showAll')}}" class="btn">Root</a> >

			@foreach($currentCat->allParents() as $a)
				<a href="{{ URL::route('category-show', Category::where('parent', '=', $a->parent)->where('id', '=', $a->id)->first()->token)}}" class="btn">{{ $a->name }}</a> >
			@endforeach

			<a href="{{ URL::route('category-show', $currentCat->token)}}" class="btn">{{ $currentCat->name }}</a>
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
			@if(!isset($token))

			<li <?php if ($order == 'alphabetical') echo "class='active'"?> >
			<a href="{{ URL::route('category-showAllSorted', array('order' => 'alphabetical') )}}">Namn</a></li>
			<li <?php if ($order == 'view_count') echo "class='active'"?> >
			<a href="{{ URL::route('category-showAllSorted', array(/* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
			<li <?php if ($order == 'score') echo "class='active'"?> >
			<a href="{{ URL::route('category-showAllSorted', array('order' => 'score') )}}">Relevans</a></li>
			<li <?php if ($order == 'revision_date') echo "class='active'"?> >
			<a href="{{ URL::route('category-showAllSorted', array(/* TODO , 'order' => 'revision_date' */) )}}">Senast uppdaterad</a>
				
			@else
			<li <?php if ($order == 'alphabetical') echo "class='active'"?> >
			<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'alphabetical') )}}">Namn</a></li>
			<li <?php if ($order == 'view_count') echo "class='active'"?> >
			<a href="{{ URL::route('category-show', array('token' => $token /* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
			<li <?php if ($order == 'score') echo "class='active'"?> >
			<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'score') )}}">Relevans</a></li>
			<li <?php if ($order == 'revision_date') echo "class='active'"?> >
			<a href="{{ URL::route('category-show', array('token' => $token /* TODO , 'order' => 'revision_date' */) )}}">Senast uppdaterad</a></li>
			@endif
		</ul>
	</h2>
	<h2>PM</h2>
	<hr>
	@foreach ($pms as $pm)
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

