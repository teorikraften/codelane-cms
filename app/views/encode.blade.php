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
	<h1>Encodea en DOCX!</h1>
	{{ Form::open(array('url' => route('post-encode-test'), 'files' => true, 'method' => 'post')) }}
		@include("includes.messages")
		<div class="form">
			<div class="content">
				<div class="row">
					<div class="description">{{ Form::label('pm', 'Välj PM') }}</div>
					<div class="input">{{ Form::select('pm', $pms, array('class' => 'text', 'placeholder' => '')) }}</div>
				</div>
				<div class="submit">
					{{ Form::submit('Encodea!', array('class' => 'submit')) }}
				</div>
			</div>
		</div>
	{{ Form::close() }}
@stop