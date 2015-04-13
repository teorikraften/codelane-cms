@extends('master')

@section('head-title')
    Granska PM "{{ $pm->title }}"
@stop

@section('head-extra')
    <script type="text/javascript" src="/js/reviewer.js"></script>
    <script type="text/javascript">
        /**
         * Initializes the comment functionality and loads earlier comments.
         */
         /*
        $(document).ready(function() {
            $('#inline-comments').html('<b>För att göra en kommentar i texten</b>: markera stycket du vill kommentera med musen och klicka på knappen "Skapa kommentar". Du kan också skriva en övergripande kommentar om hela texten längst ner på sidan.');
            @foreach ($comments as $comment)
                @if ($comment->parent_comment == 0)
                    addCommentBox({{ $comment->id }}, '{{ $comment->name }}', document.getElementById({{ $comment->id }}), '{{ $comment->content }}', false);
                @endif;
            @endforeach
            $('.comment').removeClass('active');

            // Make sure they don't overlap
            rearrange('.comment-outer');
        });

        /**
         * Starts the whole comment process onclick
         */
        function gText() {
            window.getSelection().commentize('{{ Auth::user()->name }}');
        }

        /**
         * Handles comment save.
         */
        function save(commentId) {
            var textValue = $('#val' + commentId).val();
            $.ajax({
                method: 'POST',
                url: '/spara-kommentar',
                data: { 
                    id: commentId, 
                    content: textValue, 
                    user: {{ Auth::user()->id }},
                    pm: {{ $pm->id }},
                    pmc: document.getElementById('pmcc').innerHTML,
                    _token: $('meta[name=_token]').attr('content'),
                },
                context: document.body,
                dataType: 'json',
            }).done(function() {
                alert('Sparat');
            });
        }
    </script>
@stop

@section('body')
    <h1>Slutgranska "{{ $pm->title }}"</h1>
    @include('includes.messages')
    <div style="width: 750px">
        <h2>Information</h2>
        <p>Nedan kan du kommentera texten och ge förslag till {{ count($authors) == 1 ? 'författaren' : 'författarna' }}.</p>
        <p id="inline-comments">Textfältet där du skriver din kommentar ligger längst ner på denna sida, efter själva texten.</p>
        <p><a href="#" onclick="$('#persons').slideToggle();return false;">Visa/dölj personer kopplade till detta PM</a></p>
        <div id="persons" style="display: none">
            <b>Upprättare</b>
            <ul style="padding-top: 0">
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'creator')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
            <b>Fastställare</b>
            <ul style="padding-top: 0">
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'settler')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
            <b>Författare</b>
            <ul style="padding-top: 0">
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'author')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
            <b>Granskare</b> 
            <ul style="margin-top: 0">
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'reviewer')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
            <b>Slutgranskare</b>
            <ul>
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'end-reviewer')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
            <b>Påminnare</b>
            <ul style="padding-top: 0">
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'reminder')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <!--
    <a href="#" onclick="gText()" class="action">Skapa kommentar</a>
    <div class="clear"></div>-->
    <!--<div id="pmc" class="pm-content review">
	    <div id="pmc-text">
            <h1 id="h1">{{ $pm->title }}</h1>
            <div id="pmcc">
                {{ $pm->draft }}
            </div>
        </div>
        <div id="pm-comments">
        </div>
        <div class="clear"></div>
	</div>-->
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

                            {{ date("Y-m-d") }}
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
                    <td>
                        <b>Slutgranskare: </b>
                    </td>
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
        </h1>
        {{ $pm->draft }}
    </div>
    <h2>Övergripande kommentar</h2>
    <p>Här kan du skriva en övergripande kommentar om texten som författaren kan se och förbättra texten efter.</p>
    {{ Form::model($assignment, array('action' => 'post-save-end-review', 'method' => 'post')) }}
    {{ Form::hidden('pm-id', $pm->id) }}
    <div class="form" style="width: 100%; max-width: none;">
        <div class="row">
            <div class="description">{{ Form::label('comment', 'Din kommentar') }}</div>
            <div class="input">{{ Form::textarea('comment', $assignment->content, array('class' => 'text', 'style' => 'padding: 10px 1%;  height: 200px; max-width: 900px;')) }}</div>
        </div>

        <div class="submit">
            {{ Form::submit('Spara och godkänn PM', array('class' => 'submit good', 'name' => 'accept')) }}
            {{ Form::submit('Spara och neka PM', array('class' => 'submit bad', 'name' => 'deny')) }}
        </div>
    </div>
    {{ Form::close() }}
@stop