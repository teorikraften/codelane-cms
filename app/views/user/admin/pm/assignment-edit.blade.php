@extends('master')

@section('head-title')
    Alla användare
@stop

@section('head-extra')
	<script type="text/javascript" src="/js/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/styles/token-input-facebook.css" type="text/css" />

    <script type="text/javascript">
	    $(document).ready(function() {
	        $("#creator").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($creators as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#authors").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($authors as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#settler").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($settlers as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#reviewers").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($reviewers as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#end-reviewer").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($endReviewers as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#reminder").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($reminders as $person)
	        			{'id' : '{{ $person->id }}', 'name' : '{{ $person->name . ' (' . $person->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	    });

	  	$(function() {
	    	$("#validityYear").datepicker({
		        showOtherMonths: true,
		        dayNamesMin: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
		        monthNames: [ "Januari", "Februari", "Mars", "April",
                   "Maj", "Juni", "Juli", "Augusti", "September",
                   "Oktober", "November", "December" ],
		        firstDay: 1,
		        nextText: 'Nästa',
		        prevText: 'Föreg.',
		        dateFormat: 'yy-mm-dd',
		        onSelect: function() {
		        	$("#validityTypeDate").prop('checked', true);
		        },
		        minDate: 0,
		        maxDate: "+5y",
	    	});
	    	$("#validityTime").change(function() {
	        	$("#validityTypeTime").prop('checked', true);
	        });
	  	});
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ändra personer på PM</h1>
    <p>På den här sidan kan du ändra de personer som är delaktiga i upprätthållandet av detta PM. När du sparar kommer samtliga personer få ett e-postmeddelande som berättar de tilldelats en uppgift, såvida de inte redan hade den uppgiften, och de kan se det på sin egen sida.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-pm-edit-assignments', 'method' => 'post')) }}
    	<p>Om du ändrar giltighetstid genomförs ändringen först när PM:et fastställs.</p>
    	{{ Form::hidden('id', $pm->id) }}
	    <div class="form wide">
			<div class="row">
				<div class="description">{{ Form::label('validityTime', 'Giltighetstid') }}</div>
				<div class="input">
					<table>
						<tr>
							<td>
								{{ Form::radio('validityType', 'time', $pm->validity_period != NULL, array('id' => 'validityTypeTime')) }}
							</td>
							<td>
								{{ Form::select('validityTime', array('6m' => 'Sex månader från publicering', '1y' => 'Ett år från publicering', '1y6m' => 'Ett år och sex månader från publicering', '2y' => 'Två år från publicering', '5y' => 'Fem år från publicering', $pm->validity_period => $pm->validity_period), $pm->validity_period, array('id' => 'validityTime')) }}
							</td>
						</tr>
						<tr>
							<td>
								{{ Form::radio('validityType', 'date', $pm->validity_date != NULL, array('id' => 'validityTypeDate')) }}
							</td>
							<td>
								{{ Form::text('validityDate', $pm->validity_date, array('class' => 'text', 'id' => 'validityYear')) }}
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('creator', 'Upprättare') }}</div>
				<div class="input">
					{{ Form::text('creator', Auth::user()->name, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('authors', 'Inläggare') }}</div>
				<div class="input">
					{{ Form::text('authors', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('settler', 'Fastställare') }}</div>
				<div class="input">
					{{ Form::text('settler', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('reviewers', 'Granskare') }}</div>
				<div class="input">{{ Form::text('reviewers', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('end-reviewer', 'Slutgranskare') }}</div>
				<div class="input">{{ Form::text('end-reviewer', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('reminder', 'Påminnare') }}</div>
				<div class="input">{{ Form::text('reminder', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Ändra tilldelning', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop