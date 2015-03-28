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
	<div class="first-page">
		@if(Auth::guest())

		    <h1>Välkommen</h1>
		    {{ Form::open(array('url' => route('post-sign-in'), 'method' => 'post')) }}
			@include("includes.error")
			<div class="form login">
				<a href="" class="choose-type active">Logga in</a>
				<a href="{{ URL::route('sign-up') }}" class="choose-type">Registrera dig</a>
				<div class="clear"></div>
				<div class="content">
					<div class="row">
						<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
						<div class="input">{{ Form::text('email', NULL, array('class' => 'text', 'placeholder' => 'namn@exempel.se')) }}</div>
					</div>
					<div class="row">
						<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
						<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
					</div>
					<div class="row same">
						<div class="input">{{ Form::checkbox('remember', 'yes', false, array('class' => 'checkbox', 'id' => 'remember')) }}</div>
						<div class="description">{{ Form::label('remember', 'Kom ihåg mig') }}</div>
						<div class="clear"></div>
					</div>
					<div class="row same">
						<p><a href="{{ URL::route('recover-password') }}">Jag har glömt mitt lösenord.</a></p>
					</div>
					<div class="submit">
						{{ Form::submit('Logga in', array('class' => 'submit')) }}
					</div>
				</div>
			</div>
			{{ Form::close() }}

		@else

		    {{ Form::open(array('url' => route('post-search'), 'method' => 'post')) }}
			@include("includes.error")
			<div class="form big-search">
				<div class="search-field">
					{{ Form::text('search-query', NULL, array('id' => 'search-query', 'class' => 'text', 'placeholder' => 'Sök efter PM...')) }}
				</div>
				{{ Form::submit('Sök', array('class' => 'submit')) }}
			</div>
			{{ Form::close() }}
			<div id="search-autocomplete-list"></div>

			<div style="height: 150px;"></div>

		@endif
	</div>
@stop