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
			@if (Request::isMethod('Post'))
			<div id="search-autocomplete-list"></div>
			<div style="height: 150px;"></div>
			<div class="clear"></div>
			@else
			<div id="notes-favourites-table">
				@if (count($pms) > 0)
					<div id="favourites-table">
						<h3 class="index-header">Favorit-PM</h3>
						<table valign="top" class="list index-table">
							<thead>
								<tr>
									<th>Rubrik</th>
								</tr>
							</thead>
							<tbody>
								<!-- TODO: Show top 5 most seen -->
								@foreach(array_slice($pms->toArray(), 0, 5) as $key => $pm)
										<tr>
											<td>
												<a href="{{ URL::route('pm-show', $pm['token']) }}">{{ $pm['title'] }}</a>
											</td>
										</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif

				@if ($notes->count() > 0)
					<!-- TODO: Prioritize which notes are shown -->
					<div id="notes-table">
						<h3 class="index-header">Anteckningar</h3>
					    <table valign="top" class="list index-table">
					            <tr>
					                <th>Rubrik</th>
					                <th>PM</th>
					            </tr>
					    @foreach($notes as $note)
					            <tr>
					            	<td>
					            		<a title="Visa anteckning" class="clickable-title" href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a>
					            	</td>
					                <td>
					                    <a title="Visa PM" class="clickable-title" href="{{ URL::route('pm-show', $note->pm['token']) }}">{{ $note->pm['title'] }}</a>
					                </td>
					       	    </tr>
					    @endforeach
					    </table>
					</div>
				@endif
				<div class="clear"></div>
			</div>
			@endif
		@endif
		
	</div>
	    <!--infoWindow-->   
    <div id="infoWindow" style="display:none;"><h3>
    <button onclick="hide('infoWindow')">X</button> Hjälp :: Hem</h3>
        <p>Det här är Hem.</p>
    </div>  
<!-- end of infoWindow--> 
@stop