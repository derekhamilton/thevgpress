<?php
namespace App\Queries\Comments;

use App\Models\Comment;
use Illuminate\Auth\AuthManager;

class SaveComment
{
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Save comment submitted via submission form.
     * @param string $text
     * @param ?int   $forumTopicId
     * @param ?int   $id
     */
    public function query(string $text, ?int $forumTopicId = null, ?int $id = null): Comment
    {
        return Comment::updateOrCreate(
            ['id' => $id],
            [
                'user_id'        => $this->auth->user()->id,
                'forum_topic_id' => $forumTopicId,
                'comment'        => $text,
            ]
        );
    }
}
