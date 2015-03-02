@extends('master')

@section('head-extra')
@stop

@section('body')
    <nav class="navbar clearfix">
			<div class="logo">Logga</div>
			<ul class="searchbar clearfix">
				<li><form class="search-form" role="search">
            		   <input type="text" class="text-area" placeholder="Söktext">
                   	   <button type="submit" class="btn grow">Sök</button>
         		</form></li>
			</ul>
			<ul class="menu clearfix">
				<li><a href="#">Hem</a></li>
				<li>
					<a href="#">Användare</a>
					<!--
					<ul class="menu hidden">
						<li><a href="#">Nurse</a></li>
						<li><a href="#">Doctor</a></li>
					</ul>-->
				</li>
				<li><a href="#">Logga in</a></li>
			</ul>
	</nav>
	<div id="container">
		<div id="content">
		<!-- Content goes here-->
		</div>
	</div>
	
@stop