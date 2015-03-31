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
	<a href="{{ URL::route('category-show', 'cat1') }}" class="btn">Cat 1</a>
    <a href="" class="btn">Cat 2</a>
    <a href="" class="btn">Cat 3</a>
    <a href="" class="btn">Cat 4</a>
    <a href="" class="btn">Cat 5</a>
    <a href="" class="btn">Cat 6</a>
    <a href="" class="btn">Cat 7</a>
    <a href="" class="btn">Cat 8</a>
    <a href="" class="btn">Cat 9</a>
    <a href="" class="btn">Cat 10</a>
    <a href="" class="btn">Cat 11</a>
    <a href="" class="btn">Cat 12</a>
    <a href="" class="btn">Cat 13</a>
    <a href="" class="btn">Cat 14</a>
    <a href="" class="btn">Cat 15</a>
    <a href="" class="btn">Cat 16</a>
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