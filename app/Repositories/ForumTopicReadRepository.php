<?php
namespace App\Repositories;

use App\Models\ForumTopicRead;

class ForumTopicReadRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\ForumTopicRead::class;

    public function firstOrNewByIds($userId, $topicId)
    {
        return $this->model->firstOrNew([
            'user_id' => $userId,
            'forum_topic_id' => $topicId
        ]);
    }
}
