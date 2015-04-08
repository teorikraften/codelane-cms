@extends('master')

@section('head-title')
Visa PM "{{ $pm->title }}"
@stop

@section('head-extra')

@stop

@section('body')
    <div class="pm-inf">
        <div class="clear" style="margin-top: 20px"></div>
        @include('includes.messages')

        <div id="pmc" class="pm-content">
            <h1>
                {{ $pm->title }}
                <a href="{{ URL::route('get-favourite-edit', array('goto' => 'pm', 'token' => $pm->token)) }}" title="Favoritmarkera" class={{ $favourite ? 'goldenstar' : 'greystar' }} >
                    {{ $favourite ? '&#9733;' : '&#9734;' }}
                </a> 
            </h1>
            {{ $pm->content }}
        </div>

        <div id="pmListing">
            <table>
                <tr>
                    <td>Ansvarig: </td>
                    <td>
                        @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'owner')
                        {{ $assignment->real_name }}
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Författare: </td>
                    <td>
                        @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'author')
                        {{ $assignment->real_name }}
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Granskare: </td>
                    <td>
                        @foreach ($assignments as $assignment)
                        @if ($assignment->pivot->assignment == 'reviewer')
                        {{ $assignment->real_name }}
                        @endif
                        @endforeach
                    </td>
                </tr>
            </table>

            <h2>Taggar</h2>
            @foreach($pm->tags as $tag)
                <a href="{{ URL::route('tag-show', $tag->token) }}" class="inline-action">{{ $tag->name }}</a>
            @endforeach
            @if(count($pm->tags) == 0) 
                <p>Inga taggar är associerade med detta PM.</p>
            @endif
            <a class="action" href="{{ URL::route('pm-download', $pm->token) }}">Ladda ner som .docx</a>
            <div class="clear"></div>
        </div>
    </div>
@stop