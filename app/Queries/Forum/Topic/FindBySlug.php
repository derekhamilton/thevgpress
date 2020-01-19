<?php
namespace App\Queries\Forum\Topic;

use App\Models\ForumTopic;

/**
 * Get the forum topic matching the given URL slug
 */
class FindBySlug
{
    /**
     * @return ForumTopic|null
     * @param string $slug
     */
    public function query(string $slug)
    {
        return ForumTopic::where('slug', $slug)->first();
    }
}
