<?php
namespace App\Repositories;

class ForumBoardRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\ForumBoard::class;

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
