@extends('master')

@section('head-title')
    Alla användare
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
    <h1>Ändra användare</h1>
    <p>Du håller på att ändra användaren {{ $user->real_name }}.</p>
    @include('includes.messages')
    {{ Form::model($user, array('action' => 'post-admin-users-edit', 'method' => 'post')) }}
        {{ Form::hidden('id') }}
        <div class="form">
            <div class="row">
                <div class="description">{{ Form::label('privileges', 'Användarens behörighetsnivå') }}</div>
                <div class="input">
                    {{ Form::select('privileges', array('admin' => 'Systemadministratör', 'pm-admin' => 'PM-ansvarig', 'verified' => 'Verifierad', 'unverified' => 'Overifierad'), $user->privileges) }}
                </div>
            </div>
            <div class="row">
                <div class="description">{{ Form::label('real_name', 'Namn') }}</div>
                <div class="input">{{ Form::text('real_name', NULL, array('class' => 'text')) }}</div>
            </div>
            <div class="row">
                <div class="description">{{ Form::label('email', 'E-postadress') }}</div>
                <div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
            </div>
            <div class="row same">
                <div class="input">{{ Form::checkbox('generate-password', 'yes', false, array('class' => 'checkbox', 'id' => 'generate-password')) }}</div>
                <div class="description">{{ Form::label('generate-password', 'Generera ett nytt lösenord och skicka till ovan angivna adress') }}</div>
                <div class="clear"></div>
            </div>
            <div class="submit">
    			{{ Form::submit('Spara', array('class' => 'submit')) }}
    		</div>
    	</div>
    {{ Form::close() }}
@stop