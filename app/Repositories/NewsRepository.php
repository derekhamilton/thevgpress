<?php
namespace App\Repositories;

use App\Models\News;
use DateTime;
use DB;
use Illuminate\Support\Collection;

class NewsRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\News::class;

    /**
     * @return Collection|News[]
     * @param mixed $order
     */
    private function currentNews($order)
    {
        $date    = new DateTime;
        $endDate = $date->format('Y-m-d H:i:s');
        $date->modify('-4 days');
        $startDate = $date->format('Y-m-d 00:00:00');

        if ($order == 'clicks') {
            return $this->newsByClicks($startDate, $endDate);
        }

        return $this->newsByDate($startDate, $endDate);
    }

    /**
     * @return Collection|News[]
     */
    public function currentNewsByDate()
    {
        return $this->currentNews('date');
    }

    /**
     * @return Collection|News[]
     */
    public function currentNewsByClicks()
    {
        return $this->currentNews('clicks');
    }

    /**
     * @param string $startDate Y-m-d H:i:s
     * @return Collection|News[]
     */
    public function archivedNews($startDate)
    {
        $date = new DateTime($startDate);
        $date->modify('+7 days');
        $endDate = $date->format('Y-m-d 00:00:00');
        return $this->news($startDate, $endDate);
    }

    /**
     * @param string $startDate Y-m-d H:i:s
     * @param string $endDate   Y-m-d H:i:s
     * @return Collection|News[]
     */
    public function news($startDate, $endDate)
    {
        return $this->newsBuilder($startDate, $endDate)->get();
    }

    /**
     * @param string $startDate Y-m-d H:i:s
     * @param string $endDate   Y-m-d H:i:s
     * @return Collection|News[]
     */
    public function newsByDate($startDate, $endDate)
    {
        return $this->newsBuilder($startDate, $endDate)
            ->orderBy(DB::raw("DATE_FORMAT(news.created_at, '%H-%i-%s')"), 'desc')
            ->get();
    }

    /**
     * @param string $startDate Y-m-d H:i:s
     * @param string $endDate   Y-m-d H:i:s
     * @return Collection|News[]
     */
    public function newsByClicks($startDate, $endDate)
    {
        return $this->newsBuilder($startDate, $endDate)
            ->orderBy('clicks', 'desc')
            ->get();
    }

    /**
     * @param string $startDate Y-m-d H:i:s
     * @param string $endDate   Y-m-d H:i:s
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function newsBuilder($startDate, $endDate)
    {
        return $this->model->select(
            'news.*',
            'users.username',
            DB::raw("DATE_FORMAT(news.created_at, '%a') AS day")
        )
            ->join('users', 'users.id', '=', 'news.user_id')
            ->whereBetween('news.created_at', [$startDate, $endDate])
            ->orderBy(DB::raw("DATE_FORMAT(news.created_at, '%Y-%m-%d')"));
    }
}
