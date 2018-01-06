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

        <div class="form-group row">
            <div class="col-xs-12">
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
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12">
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
            </div>
        </div>

    {{ Form::close() }}
@endif
