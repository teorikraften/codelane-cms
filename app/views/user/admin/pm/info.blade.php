@extends('master')

@section('head-title')
    Information om "{{ $pm->title }}"
@stop

@section('head-extra')

@stop

@section('body')
    <div class="pm-inf">
        <h1>
            {{ $pm->title }}
            <a href="{{ URL::route('get-favourite-edit', array('goto' => 'pm', 'token' => $pm->token)) }}" title="Favoritmarkera" class={{ $favourite ? 'goldenstar' : 'greystar' }} >
                {{ $favourite ? '&#9733;' : '&#9734;' }}
            </a> 
        </h1>
        @include('includes.messages')

        <div class="clear" style="margin-top: 20px"></div>
        <div id="pmListing">
            <table>
                <tr>
                    <th>Status: </th>
                    <td>
                        {{ $pm->status }}
                    </td>
                </tr>
                <tr>
                    <th>Sista giltighetsdatum: </th>
                    <td>
                        {{ $pm->expiration_date }}
                    </td>
                </tr>
                <tr>
                    <th>Upprättare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'creator')
                                {{ $assignment->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Inläggare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'author')
                                {{ $assignment->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Fastställare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'settler')
                                {{ $assignment->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Granskare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'reviewer')
                                {{ $assignment->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Slutgranskare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'end-reviewer')
                                {{ $assignment->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Påminnare: </th>
                    <td>
                        @foreach ($assignments as $assignment)
                            @if ($assignment->pivot->assignment == 'reminder')
                                {{ $assignment->name }}
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
            <div class="clear"></div>
        </div>
    </div>
@stop