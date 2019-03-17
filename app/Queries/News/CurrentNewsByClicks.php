<?php
namespace App\Queries\News;

use App\Models\News;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class CurrentNewsByClicks
{
    private $newsBuilder;

    public function __construct(NewsBuilder $newsBuilder)
    {
        $this->newsBuilder = $newsBuilder;
    }

    /**
     * @return Collection<News>
     */
    public function query(): Collection
    {
        return $this->newsBuilder(
            CarbonImmutable::now()->subDays(4),
            CarbonImmutable::today()
        )->orderBy('clicks', 'desc')->get();
    }
}
