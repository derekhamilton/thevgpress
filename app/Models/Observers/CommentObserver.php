<?php
namespace App\Models\Observers;

use App\Models\Comment;
use Auth;
use Messaging;
use RedisL;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        if (($validate = $comment->validate()) === true) {
            return true;
        }

        foreach ($validate->toArray() as $field) {
            foreach ($field as $message) {
                Messaging::add('errors.comment-errors', $message);
            }
        }
        return false;
    }

    public function saving(Comment $comment)
    {
        $user = Auth::user();
        RedisL::hdel('likes', $comment->id);
        RedisL::hdel('liked-by', "{$comment->id}:{$user->id}");
        return $comment->validate() === true;
    }
}
