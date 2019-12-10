<?php
namespace App\Services\Get\News;

use App\Queries\Comments\CurrentNewsComments;
use App\Queries\News\CurrentNewsByClicks;
use App\Queries\News\CurrentNewsByDate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CurrentService
{
    private $currentNewsComments;
    private $currentNewsByClicks;
    private $currentNewsByDate;

    public function __construct(
        CurrentNewsComments $currentNewsComments,
        CurrentNewsByClicks $currentNewsByClicks,
        CurrentNewsByDate $currentNewsByDate
    ) {
        $this->currentNewsComments = $currentNewsComments;
        $this->currentNewsByClicks = $currentNewsByClicks;
        $this->currentNewsByDate   = $currentNewsByDate;
    }

    /**
     * @return Collection
     * @param Request $request
     */
    public function get(Request $request)
    {
        if ($request->route('order') == 'popularity') {
            $news = $this->currentNewsByClicks->query();
        } else {
            $news = $this->currentNewsByDate->query();
        }

        // bucket news under each day
        $days = [];
        foreach ($news as $item) {
            $days[$item->day][] = $item;
        }

        $comments = $this->currentNewsComments->query();
        return collect(['days' => $days, 'comments' => $comments]);
    }
}
