@extends('master')

@section('head-title')
    Granska PM "{{ $pm->title }}"
@stop

@section('head-extra')
    <script type="text/javascript" src="/js/reviewer.js"></script>
    <script type="text/javascript">
        $(document).click(function(event) {
            // Everything should be hidden from start
            $('.comment-outer').addClass('inactive');
            $('.comment').removeClass('active');
            $('.comment-outer button').hide();
            $('.comment-box').each(function(i) {
                if ($(this).children('input.s').val() == '') {
                    $(this).parent().remove();
                }
            });

            rearrange('.comment-outer');

            var id = commentClicked(event);
            if (id == -1)   
                return;

            $('#' + id).addClass('active');
            $('#comment' + id).removeClass('inactive');
            $('#comment' + id + ' button').show();
        });

        $(document).ready(function() {
            @foreach ($reviews as $review)
                @if ($review->parent_comment == 0)
                    addCommentBox({{ $review->comment }}, '{{ $review->real_name }}', document.getElementById({{ $review->comment }}), '{{ $review->content }}', false);
                @endif;
            @endforeach
        });

        /**
         * Starts the whole comment process onclick
         */
        function gText() {
            window.getSelection().commentize('{{ Auth::user()->real_name }}');
        }

        /**
         * Handles comment save.
         */
        function save(commentId) {
            var textValue = $('#val' + commentId).val();
            $.ajax({
                method: 'GET',
                url: '/spara-kommentar',
                data: { 
                    id: commentId, 
                    content: textValue, 
                    user: {{ Auth::user()->id }},
                    _token: $('meta[name=_token]').attr('content')
                },
                context: document.body
            }).done(function() {
                alert('Sparat');
            });
        }
    </script>
@stop

@section('body')
    <h1>Granska</h1>
    <div class="pm-inf">
        <h2>Information</h2>
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
    </div>
    <a href="#" onclick="gText()" class="action">Skapa kommentar</a>
    <div class="clear"></div>
    <div id="pmc" class="pm-content">
        <canvas id="canvas" width="100" height="100"></canvas>
	    <div id="pmc-text">
            <h1 id="h1">{{ $pm->title }}</h1>
            {{ $pm->content }}
        </div>
        <div id="pm-comments">
        </div>
        <div class="clear"></div>
	</div>
    <a href="javascript:gText()" class="action">Skapa kommentar</a>
@stop