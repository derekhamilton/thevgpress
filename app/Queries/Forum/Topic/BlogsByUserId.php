<?php
namespace App\Queries\Forum\Topic;

use App\Models\ForumTopic;
use Illuminate\Support\Collection;

class BlogsByUserId
{
    /**
     * @param int $userId
     * @return ForumTopic[]|Collection
     */
    public function query(int $userId): Collection
    {
        return ForumTopic::select('forum_topics.*')
            ->where('user_id', $userId)
            ->take(10)
            ->get();
    }
}
