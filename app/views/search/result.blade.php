@extends('master')

@section('head-title')
Sökresultat av sökningen: "{{ $searchQuery }}"
@stop

@section('body')
<h1>Sökresultat</h1>
<h2 class="search">Sökning: {{ $searchQuery }}</h2>
<ul class="result">
    <h3>By content</h3>
    @foreach($result as $pm)
    <li>
      <h3><a href="{{ URL::route('pm-show', $pm->token) }}">{{ $pm->title }}</a></h3>
      <p class="description">{{ substr(trim($pm->content), 0, 200) }}...</p>
  </li>
  @endforeach
  <h3>By tag</h3>
  @foreach($tag as $tlist)
  <?php $t = $tlist[0]; ?>
  <li>
      <h3><a href="{{ URL::route('pm-show', $t->token) }}">{{ $t->title }}</a></h3>
      <p class="description">{{ substr(trim($t->content), 0, 200) }}...</p>
  </li>
  @endforeach
</ul>
@stop