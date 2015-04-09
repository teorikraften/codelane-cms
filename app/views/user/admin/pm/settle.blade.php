@extends('master')

@section('head-title')
    Fastställ PM
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
    <h1>Bekräfta: fastställ PM</h1>
    <p>Vill du verkligen fastställa PM:et "{{ $pm->title }}"? Det kommer då synas i sökningar och vara tillgängligt fram till dess revisionsdatum om det inte revideras fram tills dess.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-settle', 'method' => 'post')) }}
    {{ Form::hidden('pm-id', $pm->id) }}
    <div class="form">
		<div class="submit">
			{{ Form::submit('Ja, fastställ och publicera', array('name' => 'yes', 'class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop