@extends('master')

@section('head-title')
    Ändra kategori
@stop

@section('head-extra')
    <script type="text/javascript">
    	window.onload = function() {
    		document.getElementById('name').focus();
    	}
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ändra kategori</h1>
    @include('includes.messages')
    <p>Du håller på att ändra kategorin {{ $category->name }}.</p>
    {{ Form::model($category, array('action' => 'post-admin-categories-edit', 'method' => 'post')) }}
    {{ Form::hidden('token') }}
    <div class="form">
        <div class="row">
            <div class="description">{{ Form::label('parent', 'Överordnad kategori') }}</div>
            <div class="input">
                {{ Form::select('parent', $parentSelect, $category->parent) }}
            </div>
        </div>
		<div class="row">
            <div class="description">{{ Form::label('name', 'Kategorins nya namn') }}</div>
            <div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
        </div>
        <div class="submit">
			{{ Form::submit('Spara', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop