<?php
namespace App\Queries\Forum\Topic;

use App\Containers\Blog;
use App\Models\ForumBoard;
use App\Models\ForumTopic;

class MostRecentUserBlog
{
    public function query(int $userId): ?Blog
    {
        $comment = ForumTopic::select(
            'forum_topics.id',
            'forum_topics.user_id',
            'forum_topics.title',
            'forum_topics.slug',
            'forum_topics.created_at',
            'comments.comment'
        )
        ->join('comments', 'forum_topics.id', '=', 'comments.forum_topic_id')
        ->where('forum_topics.user_id', $userId)
        ->where('forum_topics.forum_board_id', ForumBoard::BLOGS)
        ->orderBy('forum_topics.created_at', 'desc')
        ->orderBy('comments.created_at', 'desc')
        ->first();

        if (!$comment) {
            return null;
        }

        return new Blog(
            $comment->id,
            $comment->user_id,
            $comment->title,
            $comment->slug,
            $comment->comment,
            $comment->created_at
        );
    }
}
