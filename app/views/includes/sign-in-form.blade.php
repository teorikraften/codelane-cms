{{ Form::open(array('url' => route('post-sign-in'), 'method' => 'post')) }}
	<div class="content">
		@if($e = Session::get('error'))
			<?php $error = $e; ?>
		@endif 

		@if(isset($error))	
			@if (isset($error) && is_array($error) && count($error) > 0)
				<ul class="pop error no-bullet">
					@foreach ($error as $s)
						<li>{{ $s }}</li>
					@endforeach
				</ul>
			@else
				<p class="pop error">
					{{ $error }}
				</p>
			@endif
		@endif
		<div class="row">
			<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
			<div class="input">{{ Form::email('email', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
			<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
		</div>
		<div class="row same">
			<div class="input">{{ Form::checkbox('remember', 'yes', false, array('class' => 'checkbox', 'id' => 'remember')) }}</div>
			<div class="description">{{ Form::label('remember', 'Kom ihåg mig') }}</div>
			<div class="clear"></div>
		</div>
		<div class="row same">
			<p><a href="{{ URL::route('recover-password') }}">Jag har glömt mitt lösenord.</a></p>
		</div>
		<div class="submit">
			{{ Form::submit('Logga in', array('class' => 'submit')) }}
		</div>
	</div>
{{ Form::close() }}