<div id="footer">
	<footer class="centrator">
		<div class="col">
			<h3>Sidinformation</h3>
			<p>Sidan är gjord för Clinical Innovations Fellowship 2015. Läs mer <a href="{{ URL::route('about-index') }}">om oss som står bakom</a>.</p>
		</div>
		<div class="col">
			<h3>Hjälp!</h3>
			<p><a href="{{ URL::route('help-index') }}">Här hittar du all hjälp du kan behöva.</a></p>
		</div>
		<div class="col">
			<h3>Senast lästa PM</h3>
			<ul>
				<?php $pms = PM::orderBy('id', 'desc')->take(6)->get(); // TODO ?>
				@foreach($pms as $pm)
					<li><a href="{{ URL::route('pm-show', $pm->token) }}">{{ $pm->title }}</a></li>
				@endforeach
			</ul>
		</div>
	</footer>
</div>