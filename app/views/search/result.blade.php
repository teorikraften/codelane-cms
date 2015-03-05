@extends('master')

@section('head-title')
    Sökresultat av sökningen: "{{ $searchQuery }}"
@stop

@section('body')
    <h1>Sökresultat</h1>
    <h2 class="search">Sökning: {{ $searchQuery }}</h2>
    <ul class="result">
    	<li>
    		<h3><a href="{{ URL::route('pm-show', 'hjartklinikens-papperskorgar') }}">Hjärtklinikens papperskorgar</a></h3>
    		<p class="description">Alla Hjärtklinikens papperskorgar ska vara röda och tillverkade av 
    			Johan Lantz ... om Jacobi har gjort papperskorgen ska detta utmärkas tydligt.</p>
    	</li>
    	<li>
    		<h3><a href="{{ URL::route('pm-show', 'bokning-av-motesrum') }}">Bokning av mötesrum</a></h3>
    		<p class="description">... om ett mötesrum bokas av Andy kommer det förmodligen inte vara bokat länge till.
    			Detta eftersom Andy ibland glömmer av boka. Eric brukar glömma att kvittera.</p>
    	</li>
    </ul>
@stop