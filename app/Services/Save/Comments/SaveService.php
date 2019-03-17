<?php
namespace App\Services\Save\Comments;

use Illuminate\Http\Request;
use App\Queries\Comments\SaveComment;
use App\Models\Comment;

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
