@extends('master')

@section('head-title')
    Visa category: 
    <?php if (isset($token)) { echo $token; } ?>
@stop

@section('body')
    {{ $pm }}
@stop