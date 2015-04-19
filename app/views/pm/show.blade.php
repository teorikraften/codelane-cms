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
        <a class="action" href="{{ URL::route('get-favourite-edit', array('goto' => 'pm', 'token' => $pm->token)) }}">{{ $favourite ? '&#9733; Ta bort som favorit' : '&#9734; Favoritmarkera' }}</a>
        <a class="action" href="{{ URL::route('note-add', $pm->title) }}">Ny anteckning</a>
        <div class="clear"></div>

        <div id="pmc" class="pm-content">
            <div class="pm-info">
                {{ HTML::image('images/logo.png') }}
                <div class="pm-icons">
                    @if (!$unreadNotifications->isEmpty())
                     <a class="notes-notification-info" href="{{ URL::route('notification-show-all') }}" title="Du har en eller flera olästa notifieringar associerade med detta pm">
                         {{ HTML::image('images/informationbigger.png', 'Du har en eller flera olästa notifieringar associerade med detta pm')  }}
                    </a>
                    @endif
                    @if (isset($note))
                     <a class="notes-notification" href="{{ URL::route('note-show', $note->id) }}" title="Du har en anteckning associerad med detta pm">
                         {{ HTML::image('images/roleRel.png', 'Du har en anteckning associerad med detta pm')  }}
                    </a>
                    @endif
                 </div>
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
                                <a title="Skicka meddelande" href="{{ URL::route('notification-add', array($author->email, $pm->title)) }}">
                                    {{ $author->name . ($author === end($persons['authors']) ? ' ' : ', ') }}
                                </a>
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