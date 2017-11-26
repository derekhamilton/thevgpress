<section id="comments">
    @foreach ($comments as $comment)
        @include ('comment', array('comment' => $comment))
    @endforeach
</section>

@include (
    'reportBagMessages',
    array(
        'messages' => $alert->get('commentErrors'),
        'id' => 'comment-errors',
        'class' => 'danger'
    )
)

@include ('comments-form', array('forumTopicId' => isset($forumTopicId) ? $forumTopicId : null))
