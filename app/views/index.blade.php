@extends('master')

@section('head-extra')
  	<script type="text/javascript">
	  $(function() {
	    $("#search-query").autocomplete({
	      source: '/keywords',
	      appendTo: '#search-autocomplete-list'
	    });
	  });

	  window.onload = function() {
	  	$("#sign-in-button").attr('href', '#');
	  	$("#sign-up-button").attr('href', '#');
	  	document.getElementById('sign-in-button').onclick = function() {
	  		$("#sign-in").show();
	  		$("#sign-up").hide();
	  		$("#sign-in-button").addClass('active');
	  		$("#sign-up-button").removeClass('active');
	  	};
	  	document.getElementById('sign-up-button').onclick = function() {
	  		$("#sign-up").show();
	  		$("#sign-in").hide();
	  		$("#sign-up-button").addClass('active');
	  		$("#sign-in-button").removeClass('active');
	  	};
	  }
	</script>
@stop

@section('body')
	<div class="first-page">
		@if(Auth::guest())

		    <h1>Välkommen</h1>
			<div class="form login">
				<a href="" class="choose-type active" id="sign-in-button">Logga in</a>
				<a href="{{ URL::route('sign-up') }}" class="choose-type" id="sign-up-button">Registrera dig</a>
				<div class="clear"></div>
				<div id="sign-in">
					{{ Form::open(array('url' => route('post-sign-in'), 'method' => 'post')) }}
					<div class="content">
						@if($e = Session::get('error'))
							<?php $error = $e; ?>
						@endif 

						@if(isset($error))	
							@if (isset($error) && is_array($error) && count($error) > 0)
								<ul class="pop error no-bullet">
									@foreach ($error as $s)
										<li>{{ $s }}</li>
									@endforeach
								</ul>
							@else
								<p class="pop error">
									{{ $error }}
								</p>
							@endif
						@endif
						<div class="row">
							<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
							<div class="input">{{ Form::text('email', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
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
						{{ Form::close() }}
					</div>
				</div>
				<div id="sign-up" style="display: none;">
					{{ Form::open(array('url' => route('post-sign-up'), 'method' => 'post'))}}
					<div class="content">
						<div class="row">
							<div class="description">{{ Form::label('name', 'Namn') }}</div>
							<div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
						</div>
						<div class="row">
							<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
							<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
						</div>
						<div class="row">
							<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
							<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
						</div>
						<div class="row">
							<div class="description">{{ Form::label('password', 'Upprepa lösenord') }}</div>
							<div class="input">{{ Form::password('confirm_password', array('class' => 'text')) }}</div>
						</div>
						<div class="submit">
							{{ Form::submit('Registrera', array('class' => 'submit')) }}
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>

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