<?php
namespace App\Repositories;

class CommentRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\Comment::class;

    public function newsComments($startDate = null, $endDate = null)
    {
        $comments = $this->model->whereNull('forum_topic_id');

        if (is_null($startDate)) {
            $startDate = date('Y-m-d 00:00:00', strtotime("-7 DAYS"));
        }

        if (is_null($endDate)) {
            $endDate = date('Y-m-d H:i:s');
        }

        $comments->whereBetween('created_at', [$startDate, $endDate]);
        return $comments;
    }
}
