@extends('master')

@section('head-title')
    Ta bort PM
@stop

@section('head-extra')
    <script type="text/javascript">
    	window.onload = function() {
    		document.getElementById('yes-button').focus();
    	}
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Revidera PM</h1>
    <p><b>Vill du verkligen börja revidera "{{ $pm->title }}"?</b></p>
    <p>Om du fortfarande vill att PM:et ska synas vid sökningar för vanliga användare låter du kryssrutan nedan vara ifylld. Vill du inte att det ska synas, tar du bort markeringen från rutan.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-revise', 'method' => 'post')) }}
    {{ Form::hidden('pm-id', $pm->id) }}
    <div class="form">
        <div class="row same">
            <div class="input" style="width:30px">{{ Form::checkbox('published', 'yes', true, array('style' => 'width: 30px', 'class' => 'checkbox', 'id' => 'published')) }}</div>
            <div class="description" style="float: left;">
                <label for="published">
                    Fortsätt visa detta PM i databasen fram till sista revisionsdatumet.
                </label>
            </div>
            <div class="clear" style="height: 20px;"></div>
        </div>
		<div class="submit">
			{{ Form::submit('Ja, börja revidera', array('name' => 'yes', 'class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej, avbryt', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop