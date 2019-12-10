<?php
namespace App\Queries\Comments;

use App\Models\Comment;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class CurrentNewsComments
{
    /**
     * Get current news stories
     * @param null|mixed $startDate
     * @param null|mixed $endDate
     */
    public function query($startDate = null, $endDate = null): Collection
    {
        $comments = Comment::whereNull('forum_topic_id');

        if (is_null($startDate)) {
            $startDate = CarbonImmutable::today()->subDays('7');
        }

        if (is_null($endDate)) {
            $endDate = CarbonImmutable::now();
        }

        $comments->whereBetween('created_at', [$startDate, $endDate]);
        return $comments->get();
    }
}
