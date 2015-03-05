@extends('master')

@section('head-extra')
@stop

@section('body')
	<h1>Import</h1>
    <p>Försökte importera filen: {{ $filename }}</p>
    <h2>Output</h2>
    <div style="font-family: monospace">
	    {{ print_r($content) }}
	</div>
@stop