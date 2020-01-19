<?php
namespace App\Services\Save\Comments;

use App\Models\Comment;
use App\Queries\Comments\SaveComment;
use Illuminate\Http\Request;

final class SaveService
{
    private $saveComment;

    public function __construct(SaveComment $saveComment)
    {
        $this->saveComment = $saveComment;
    }

    public function save(Request $request): Comment
    {
        $comment = $this->saveComment->query(
            $request->input('comment'),
            $request->input('forumTopicId'),
            $request->input('id')
        );

        return $comment;
    }
}
