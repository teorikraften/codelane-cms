@if($w = Session::get('warning'))
	<?php $warning = $w; ?>
@endif 

@if($m = Session::get('message'))
	<?php $message = $m; ?>
@endif 

@if(isset($warning))
	<?php $message = $warning; ?>
@endif

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