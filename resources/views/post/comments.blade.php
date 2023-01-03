@foreach($comments as $comment)
    <div class="display-comment" style="margin-left:40px;">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->comment }}</p>         
    </div>
@endforeach  