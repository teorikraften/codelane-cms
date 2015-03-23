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
	<div class="pm-info">
	<table>
		<tr>
			<td>Ansvarig</td>
			<td>Författare</td>
			<td>Granskare</td>
		</tr>
		<tr>
			<td>
                @foreach ($assignments as $assignment)
                    @if ($assignment->pivot->assignment == 'owner')
                        {{ $assignment->real_name }}
                    @endif
                @endforeach
            </td>
			<td>
                @foreach ($assignments as $assignment)
                    @if ($assignment->pivot->assignment == 'author')
                        {{ $assignment->real_name }}
                    @endif
                @endforeach
            </td>
			<td>
                @foreach ($assignments as $assignment)
                    @if ($assignment->pivot->assignment == 'reviewer')
                        {{ $assignment->real_name }}
                    @endif
                @endforeach
            </td>
		</tr>
	</table>
	</div>
    <h1>{{ $pm->title }}</h1>
    <div id="pmc" class="pm-content">
	    {{ $pm->content }}
	</div>
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
@stop