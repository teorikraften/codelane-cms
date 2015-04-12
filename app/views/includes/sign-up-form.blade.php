{{ Form::open(array('url' => route('post-sign-up'), 'method' => 'post'))}}
	<div class="content">
		<div class="row">
			<div class="description">{{ Form::label('name', 'Namn') }}</div>
			<div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
			<div class="input">{{ Form::email('email', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
			<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('password_confirmation', 'Upprepa lösenord') }}</div>
			<div class="input">{{ Form::password('password_confirmation', array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Registrera', array('class' => 'submit')) }}
		</div>
	</div>
{{ Form::close() }}