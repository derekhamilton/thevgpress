<?php
namespace App\Services\Get;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Repositories\NewsRepository;

final class NewsCurrentService
{
    /** @var CommentRepository */
    private $commentRepo;

    /** @var NewsRepository */
    private $newsRepo;

    /**
     * @param CommentRepository $commentRepo
     * @param NewsRepository    $newsRepo
     */
    public function __construct(
        CommentRepository $commentRepo,
        NewsRepository $newsRepo
    ) {
        $this->commentRepo = $commentRepo;
        $this->newsRepo    = $newsRepo;
    }

    /**
     * @return Collection
     */
    public function get(Request $request)
    {
        if ($request->route('order') == 'popularity') {
            $news = $this->newsRepo->currentNewsByClicks();
        } else {
            $news = $this->newsRepo->currentNewsByDate();
        }

        // bucket news under each day
        $days = [];
        foreach ($news as $item) {
            $days[$item->day][] = $item;
        }

        $comments = $this->commentRepo->newsComments();
        return collect(['days' => $days, 'comments' => $comments]);
    }
}
