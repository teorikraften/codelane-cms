@extends('master')

@section('head-extra')
  	<script type="text/javascript">
	  $(function() {
	    $("#search-query").autocomplete({
	      source: '/keywords',
	      appendTo: '#search-autocomplete-list'
	    });
	  });
	</script>
@stop

@section('body')
	<h1>Resultat</h1>
	{{ $content }}
@stop