@extends('master')

@section('head-extra')
  	{{ HTML::script('js/index-page.js'); }}
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
					@include('includes.sign-in-form')
				</div>
				<div id="sign-up" style="display: none;">
					@include('includes.sign-up-form')
				</div>
			</div>

		@else

		    {{ Form::open(array('url' => route('post-search'), 'method' => 'post')) }}
			@include("includes.error")
				<div class="form big-search">
					<div class="search-field">
						{{ Form::text('search-query', NULL, array(
							'id' => 'search-query', 'class' => 'text', 'placeholder' => 'Sök efter PM...')) }}
					</div>
					{{ Form::submit('Sök', array('class' => 'submit')) }}
				</div>
			{{ Form::close() }}
			<div id="search-autocomplete-list"></div>
			<div style="height: 150px;"></div>

		@endif
		
	</div>
	    <!--infoWindow-->   
    <div id="infoWindow" style="display:none;"><h3>
    <button onclick="hide('infoWindow')">X</button> Hjälp :: Hem</h3>
        <p>Det här är Hem.</p>
    </div>  
<!-- end of infoWindow--> 
@stop