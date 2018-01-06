<?php
namespace App\Queries\Forum\Topic;

use App\Models\ForumTopic;
use App\Models\User;
use App\Queries\Forum\Topic\FirstOrNewTopicRead;

/**
 * Save a topic as having been viewed by the user
 */
class MarkAsViewed
{
    /** @var FirstOrNewTopicRead */
    private $newTopicRead;

    /**
     * @param FirstOrNewTopicRead $newTopicRead
     */
    public function __construct(FirstOrNewTopicRead $newTopicRead)
    {
        $this->newTopicRead = $newTopicRead;
    }

    public function query(User $user, ForumTopic $topic, int $page = null, int $perPage = null) : void
    {
        $topicRead = $this->newTopicRead->query($user->id, $topic->id);
        $lastCommentVisible = $topic->lastCommentVisible($page, $perPage);

        if ($lastCommentVisible > $topicRead->viewed) {
            $topicRead->views = $lastCommentVisible;
        }

        $topicRead->save();
    }
}
