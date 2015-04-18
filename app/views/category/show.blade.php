@extends('master')

@section('head-title')
	Kategori {{ $category or '' }}
@stop

@section('head-extra')
	{{ HTML::script('js/category.js') }}
    {{ HTML::script('js/infoWindow.js'); }}
@stop

@section('body')   
	<div class="breadcrumb">
		Du är här: {{ $breadcrumb or '' }} 
		<button onclick="enable('infoWindow')">?</button>

	</div>


	@if(isset($category))
		<h1>{{ $category }}</h1>
	@endif

	@include('includes.messages')

	<div id="categories">
		<h3>Kategorier</h3>
		{{ $catList }}
	</div>


	<!--infoWindow-->  
    <div id="infoWindow" style="display:none;"><h3>
		<button onclick="disable('infoWindow')">X</button> Hjälp :: Kategori</h3>
        <p>Du kan 
        	<b><ins>välja</ins></b> en kategori för att visa de PM som ingår i kategorin och
        	<b><ins>filtrera</ins></b> resultaten.</p>
    </div>  
    
<!-- end of infoWindow-->    

	<div id="category-output">
		
		<div class="result">
			<ul class="sortby">
				<li{{ $order == 'alphabetical' ? " class='active'" : '' }} >
				<a href="">Namn</a></li>
			</ul>
			<!--
			@if (isset($token))
				<ul class="sortby">
					<li{{ $order == 'alphabetical' ? " class='active'" : '' }} >
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'alphabetical') )}}">Namn</a></li>
					<li{{ $order == 'view_count' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show', array('token' => $token/* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
					<li{{ $order == 'score' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => 'score') )}}">Relevans</a></li>
					<li{{ $order == 'revision_date' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show', array('token' => $token , 'order' => 'revision_date' ) )}}">Senast uppdaterad</a>
				</ul>
			@else
				<ul class="sortby">
					<li{{ $order == 'alphabetical' ? " class='active'" : '' }} >
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => 'alphabetical') )}}">Namn</a></li>
					<li{{ $order == 'view_count' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token/* TODO , 'order' => 'view_count' */) )}}">Popularitet</a></li>
					<li{{ $order == 'score' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => 'score') )}}">Relevans</a></li>
					<li{{ $order == 'revision_date' ? " class='active'" : '' }}>
					<a href="{{ URL::route('category-show-all-sorted', array('token' => $token , 'order' => 'revision_date') )}}">Senast uppdaterad</a>
				</ul>
			@endif
		-->
			<div class="clear"></div>
		</div>

		<ul class="result">
			@foreach ($pms as $pm)
				<li>
					<h3>
						<a href="{{ URL::route('get-favourite-edit', array('goto' => 'resultat', 'token' => $pm['pm']->token)) }}" title="Favoritmarkera" class="{{ $pm['pm']->favouriteByUser() ? 'goldenstar' : 'greystar' }} small" >
            				{{ $pm['pm']->favouriteByUser() ? '&#9733;' : '&#9734;' }}
        				</a>
        				<a href="{{ URL::route('pm-show', $pm['pm']->token) }}">{{ $pm['pm']->title }}</a>
        			</h3>
					<div class="tags">
						@if (count($pm['pm']->tags) > 0)
							<b>Taggar:</b>
						@endif
						@foreach($pm['pm']->tags as $tag)
							<a href="{{ URL::route('tag-show', $tag->token) }}">{{ $tag->name }}</a>
						@endforeach

						<b>Giltigt till: {{ '2015-06-27'; /* TODO */ }}</b>
						<div class="clear"></div>
					</div>
					<p class="description">{{ substr(trim(str_replace("&nbsp;", " ", strip_tags($pm['pm']->content))), 0, 200) }}...</p>
				</li>
			@endforeach
		</ul>

		<div class="pagination">
		<ul class="pagination">
			@if($page > 1)
				<li>
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => $order, 'page' => ($page-1) ) ) }}">
						Föregående
					</a>
				</li>
			@endif
			@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
				@if($page == $pageNumber)
					<li class="active">
						<span>{{ $pageNumber }}</span>
					</li>
				@else
					<li class="active">
						<a {{ $pageNumber == $page ? "class='active'" : '' }} href="{{ URL::route('category-show', array('token' => $token, 'order' => $order , 'page' => $pageNumber ) )}}">
							{{ $pageNumber }}
						</a>
					</li>
				@endif
			@endfor
			@if($page < $maxPage)
				<li>
					<a href="{{ URL::route('category-show', array('token' => $token, 'order' => $order , 'page' => ($page+1) ) ) }}">Nästa</a>
				</li>
			@endif
		</ul>
		</div>
	</div>

	<div class="clear"></div>


<?php /*
			<tbody>
				<tr>
					<td>
						@if ($page > 1)
						<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order, 'page' => ($page-1) ) ) }}">Föregående</a>
						@endif
					</td>
					@if ($maxPage > 1)
						@for($pageNumber = 1; $pageNumber <= $maxPage; $pageNumber++)
						<td>
							<a {{ $pageNumber == $page ? "class='active'" : '' }} href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order , 'page' => $pageNumber ) )}}"> {{ $pageNumber }} </a>
						</td>
						@endfor
					@endif
					<td>
						@if ($page < $maxPage)
						<a href="{{ URL::route('category-show-all-sorted', array('token' => $token, 'order' => $order , 'page' => ($page+1) ) ) }}">Nästa</a>
						@endif
					</td>
				</tr>
			</tbody>
			@endif
		</table>
	</div>
		*/ ?>
@stop

