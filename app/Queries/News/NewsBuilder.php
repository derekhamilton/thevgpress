<?php
namespace App\Queries\News;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use DB;

class NewsBuilder
{
    public function query($startDate, $endDate): Builder
    {
        return News::select(
                'news.*',
                'users.username',
                DB::raw("DATE_FORMAT(news.created_at, '%a') AS day")
            )
            ->join('users', 'users.id', '=', 'news.user_id')
            ->whereBetween('news.created_at', [$startDate, $endDate])
            ->orderBy(DB::raw("DATE_FORMAT(news.created_at, '%Y-%m-%d')"));
    }
}
