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
	<h1>Decodea en DOCX!</h1>
	{{ Form::open(array('url' => route('post-decode-test'), 'files' => true, 'method' => 'post')) }}
		@include("includes.messages")
		<div class="form">
			<div class="content">
				<div class="row">
					<div class="description">{{ Form::label('file', 'Välj fil') }}</div>
					<div class="input">{{ Form::file('file', array('class' => 'text', 'placeholder' => '')) }}</div>
				</div>
				<div class="submit">
					{{ Form::submit('Decodea!', array('class' => 'submit')) }}
				</div>
			</div>
		</div>
	{{ Form::close() }}
@stop