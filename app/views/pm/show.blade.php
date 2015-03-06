@extends('master')

@section('head-title')
    Visa PM med token: {{ $pm }}
@stop

@section('head-extra')
    <script type="text/javascript">

    	function changeSize(divT, diff, valSpan) {
    		var divToChange = document.getElementById(divT);
    		var valueSpan = document.getElementById(valSpan);
    		var value = parseInt(valueSpan.innerHTML) + diff;
    		if (value < 0)
    			value = 0;
    		if (value > 500)
    			value = 500;
    		valueSpan.innerHTML = value;
    		divToChange.style.fontSize = value/100 + 'em';
    	}

    </script>
@stop

@section('body')
    <h1>{{ $pm->title }}</h1>
    <a class="action" href="{{ URL::route('pm-download', $pm->token) }}">Ladda ner PM (.pdf)</a>
    <a class="action" href="{{ URL::route('pm-download', $pm->token) }}">Skriv ut</a>
    <span class="meter">
    	<a href="javascript:void()" onclick="changeSize('pmc', -10, 'size')" class="first">Minska</a>
    	<span class="middle">
    		Textstorlek: 
    		<span id="size">120</span>
    		%
    	</span>
    	<a href="javascript:void()" onclick="changeSize('pmc', 10, 'size')" class="last">Öka</a>
    </span>
    <div id="pmc" class="pm-content">
	    {{ $pm->content }}
	</div>
@stop