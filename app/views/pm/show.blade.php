@extends('master')

@section('head-title')
Visa PM "{{ $pm->title }}"
@stop

@section('head-extra')
    {{ HTML::style('styles/print-pm.css', array('media' => 'print')) }}
@stop

@section('body')
    <div class="pm-inf">
        <div class="clear space"></div>
        @include('includes.messages')
        <a class="action" href="javascript:window.print()">{{ HTML::image('images/print.png') }}Skriv ut</a>
        <a class="action" href="{{ URL::route('pm-download', $pm->token) }}">Ladda ner som .docx</a>
        <div class="clear"></div>

        <div id="pmc" class="pm-content">
            <div class="pm-info">
                {{ HTML::image('images/logo.png') }}
                <table>
                    <tr>
                        <td colspan="4">
                            <b>
                                Fastställd av

                                {{ $persons['settlers'][0]->name or 'någon' }}

                                den 

                                {{ date("Y-m-d", strtotime($persons['settlers'][0]->pivot->done_at)) }}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Författare: </b></td>
                        <td colspan="3">
                            @foreach ($persons['authors'] as $key => $author)
                                {{ $author->name . ($author === end($persons['authors']) ? ' ' : ', ') }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><b>Granskare: </b></td>
                        <td>
                            @foreach ($persons['reviewers'] as $key => $reviewer)
                                {{ $reviewer->name . ($reviewer === end($persons['reviewers']) ? ' ' : ', ') }}
                            @endforeach
                        </td>
                        <td><b>Slutgranskare: </b></td>
                        <td>
                            @foreach ($persons['end-reviewers'] as $key => $reviewer)
                                {{ $reviewer->name . ($reviewer === end($persons['end-reviewers']) ? ' ' : ', ') }}
                            @endforeach
                        </td>
                    </tr>
                </table>
                <div class="clear"></div>
            </div>
            <h1>
                {{ $pm->title }}
                <a href="{{ URL::route('get-favourite-edit', array('goto' => 'pm', 'token' => $pm->token)) }}" title="Favoritmarkera" class={{ $favourite ? 'goldenstar' : 'greystar' }} >
                    {{ $favourite ? '&#9733;' : '&#9734;' }}
                </a> 
            </h1>
            {{ $pm->content }}
        </div>

        <div class="tags">
            <h2>Taggar</h2>
            @foreach($pm->tags as $tag)
                <a href="{{ URL::route('tag-show', $tag->token) }}" class="inline-action">{{ $tag->name }}</a>
            @endforeach
            @if(count($pm->tags) == 0) 
                <p>Inga taggar är associerade med detta PM.</p>
            @endif
        </div>
    </div>
@stop