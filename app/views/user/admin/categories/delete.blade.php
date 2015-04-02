@extends('master')

@section('head-title')
    Alla kategorier
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
    <h1>Bekräfta: ta bort kategori</h1>
    @include('includes.messages')
    <p>Vill du verkligen ta bort kategorin {{ $category->name }}?</p>
    {{ Form::open(array('action' => 'post-admin-categories-delete', 'method' => 'post')) }}
    {{ Form::hidden('category-token', $category->token) }}
    <div class="form">
		<div class="submit">
			{{ Form::submit('Ja', array('name' => 'yes', 'class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop