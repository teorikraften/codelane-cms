@if(isset($message))
	@if (is_array($message) && count($message) > 0)
		<ul class="pop message">
			@foreach ($message as $s)
				<li>{{ $s }}</li>
			@endforeach
		</ul>
	@else
		<p class="pop message">
			{{ $message }}
		</p>
	@endif
@endif