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
        $(document).ready(function() {
            $('#inline-comments').html('<b>För att göra en kommentar i texten</b>: markera stycket du vill kommentera med musen och klicka på knappen "Skapa kommentar". Du kan också skriva en övergripande kommentar om hela texten längst ner på sidan.');
            @foreach ($comments as $comment)
                @if ($comment->parent_comment == 0)
                    addCommentBox({{ $comment->id }}, '{{ $comment->name }}', document.getElementById({{ $comment->id }}), '{{ $review->content }}', false);
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
        <p>
            Författare är 
            <ul>
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'author')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
        </p>
        <p>
            Granskare är 
            <ul>
                @foreach ($assignments as $ass)
                    @if ($ass->pivot->assignment == 'reviewer')
                        <li>{{ $ass->name }} ({{ $ass->email }})</li>
                    @endif
                @endforeach
            </ul>
        </p>
    </div>
    <a href="#" onclick="gText()" class="action">Skapa kommentar</a>
    <div class="clear"></div>
    <div id="pmc" class="pm-content review">
	    <div id="pmc-text">
            <h1 id="h1">{{ $pm->title }}</h1>
            <div id="pmcc">
                {{ $pm->draft }}
            </div>
        </div>
        <div id="pm-comments">
        </div>
        <div class="clear"></div>
	</div>
    <div class="clear" style="height: 100px"></div>
    <h2>Övergripande kommentar</h2>
    <p>Här kan du skriva en övergripande kommentar om texten som författaren kan se och förbättra texten efter. Om du godkänner PM:et måste du klicka i rutan längst ner och sedan trycka på "Spara".</p>
    {{ Form::model($assignment, array('action' => 'post-save-end-review', 'method' => 'post')) }}
    {{ Form::hidden('pm-id', $pm->id) }}
    <div class="form" style="width: 100%; max-width: none;">
        <div class="row">
            <div class="description">{{ Form::label('comment', 'Din kommentar') }}</div>
            <div class="input">{{ Form::textarea('comment', $assignment->content, array('class' => 'text', 'style' => 'padding: 10px 1%;  height: 200px; width: 102%;')) }}</div>
        </div>
        <div class="row same">
            <div class="input" style="width:30px">{{ Form::checkbox('accept', 'yes', $assignment->accepted, array('style' => 'width: 30px', 'class' => 'checkbox', 'id' => 'accept')) }}</div>
            <div class="description" style="float: left;">
                <label for="accept">
                    Jag godkänner detta PM. <span style="font-weight:normal;">(Klicka inte i rutan om du inte godkänner. Din kommentar sparas ändå när du trycker på knappen nedan.)</span>
                </label>
            </div>
            <div class="clear" style="height: 20px;"></div>
        </div>
        <div class="submit">
            {{ Form::submit('Spara', array('class' => 'submit')) }}
        </div>
    </div>
    {{ Form::close() }}
@stop