@extends('master')

@section('head-title')
    Visa category: 
    <?php if (isset($token)) { echo $token; } ?>
@stop

@section('head-extra')
    <link rel="stylesheet" type="text/css" href="/styles/catstyle.css">
@stop

@section('body')

<div class="" id="categories">
	@foreach($categories as $category1)
		<a href="{{ URL::route('category-show', $category1->token) }}" class="btn">{{ $category1->name }}</a>
	@endforeach
</div>
<div class="clear" id="category-output">
	<strong>
	Detta är en lista med alla kategorier och under kategorier från head kategorien som defineras i urlen.

	OBS förstå hur listan är uppbyggd innan du försöker använda den. (rekursion krävs). Jag hjälper dig om du säger vad du vill ha.
	<br>
	Lägre ner kommer alla om som ligger i denna kategori eller en underkategori
	<br>
	Author - Johan Jonasson
	<br>
	</strong>
</div>
    {{ var_dump($category) }}


	
	PM_LISTA

	<?php if (isset($pms)) { var_dump($pms); } ?>

@stop