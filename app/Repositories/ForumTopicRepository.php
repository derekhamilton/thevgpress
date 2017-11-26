<?php
namespace App\Repositories;

use App\Models\ForumTopic;
use App\Models\User;

use App;

class ForumTopicRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\ForumTopic::class;

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function viewed(User $user = null, ForumTopic $topic, $page, $perPage)
    {
        if (is_null($user)) {
            return;
        }

        $topicReadRepo = App::make(ForumTopicReadRepository::class);
        $topicRead = $topicReadRepo->firstOrNewByIds($user->id, $topic->id);
        $lastCommentVisible = $topic->lastCommentVisible($page, $perPage);

        if ($lastCommentVisible > $topicRead->viewed) {
            $topicRead->views = $lastCommentVisible;
        }

        $topicRead->save();
    }
}
