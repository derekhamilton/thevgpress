@if (!$loggedInUser)
    <a href="#">Join</a> or <a href="#">Login</a> to comment
@else
    {{
        Form::open(
            array(
                'url' => route('comment/post'),
                'class' => 'form-horizontal ajax'
            )
        )
    }}

        {{ Form::hidden('forumTopicId', $forumTopicId, ['id' => 'forumTopicId']) }}

        {{
            Form::textarea(
                'comment',
                '',
                array(
                    'id' => 'comment',
                    'class' => 'form-control',
                    'placeholder' => 'comment'
                )
            )
        }}

        {{
            Form::submit(
                'Submit',
                array(
                    'class' => 'btn btn-primary'
                )
            )
        }}

        {{
            Form::button(
                'Preview',
                array(
                    'class' => 'btn btn-info preview'
                )
            )
        }}

    {{ Form::close() }}
@endif
