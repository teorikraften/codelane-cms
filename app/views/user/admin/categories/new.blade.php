@extends('master')

@section('head-title')
    Skapa kategori
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ny kategori</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-admin-categories-new', 'method' => 'post')) }}
    <div class="form">
        <div class="row">
            <div class="description">{{ Form::label('parent', 'Överordnad kategori') }}</div>
            <div class="input">
                {{ Form::select('parent', $parentSelect, 0) }}
            </div>
        </div>
		<div class="row">
			<div class="description">{{ Form::label('name', 'Kategorins namn') }}</div>
			<div class="input">{{ Form::text('name', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Spara kategori', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop