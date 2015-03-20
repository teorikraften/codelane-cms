@if($e = Session::get('error'))
	<?php $error = $e; ?>
@endif 

@if(isset($error))	
	@if (isset($error) && is_array($error) && count($error) > 0)
		<ul class="pop error">
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