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

    <div class="pm-inf">
        <h2>Information</h2>
        <table>
            <tr>
                <td>Ansvarig: </td>
                <td>
                    @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'owner')
                            {{ $assignment->real_name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Författare: </td>
                <td>
                    @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'author')
                            {{ $assignment->real_name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Granskare: </td>
                <td>
                    @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'reviewer')
                            {{ $assignment->real_name }}
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
        
        <h2>Taggar</h2>
        @foreach($pm->tags as $tag)
            <a href="{{ URL::route('tag-show', $tag->token) }}" class="inline-action">{{ $tag->name }}</a>
        @endforeach
    </div>
    <h1>{{ $pm->title }}</h1>
    <div id="pmc" class="pm-content">
	    {{ $pm->content }}
	</div>
@stop