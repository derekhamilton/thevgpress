<?php
namespace App\Queries\Forum\Topic;

use App\Models\ForumTopicRead;

/**
 * Return the record indicated if a topic had been viewed
 */
class FirstOrNewTopicRead
{
    public function query(int $userId, int $topicId) : ForumTopicRead
    {
        return ForumTopicRead::firstOrNew([
            'user_id'        => $userId,
            'forum_topic_id' => $topicId
        ]);
    }
}
