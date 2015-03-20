@if($s = Session::get('success'))
	<?php $success = $s; ?>
@endif 

@if(isset($success))
	@if (is_array($success) && count($success) > 0)
		<ul class="pop success">
			@foreach ($success as $s)
				<li>{{ $s }}</li>
			@endforeach
		</ul>
	@else
		<p class="pop success">
			{{ $success }}
		</p>
	@endif
@endif