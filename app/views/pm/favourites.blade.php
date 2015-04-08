@extends('master')

@section('head-title')
	Dina favoriter
@stop

@section('head-extra')
	{{ HTML::script('js/sort.js') }}
@stop

@section('body')
	
	<h1>Dina favoriter</h1>

	@include('includes.messages')

	@if(count($pms) == 0)

		<p>Du har inte favoritmarkerat några PM ännu. Så här gör du för att göra det:</p>
		<ol>
			<li>Gå in på det PM du vill favoritmarkera</li>
			<li>Tryck på den gråa stjärnan</li>
			<li>När den gråa stjärnan har blivit gul är du klar</li>
			<li>Nästa gång du kommer hit kommer PM:et synas här</li>
		</ol>

	@else
		<table class="list sortable">
			<thead>
				<tr>
					<th class="sorttable_nosort action"></th>
					<th>Rubrik</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pms as $key => $pm)
					<tr>
						<td>
							<a href="{{ URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $pm->token)) }}" title="Favorit" class="goldenstar">
								&#9733;
							</a>
						</td>
						<td>
							<a href="{{ URL::route('pm-show', $pm->token) }}">{{ $pm->title }}</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@stop