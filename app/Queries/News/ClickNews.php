<?php
namespace App\Queries\News;

use App\Models\News;

final class ClickNews
{
    /**
     * Increment the click counter for a news item.
     */
    public function query(int $id): int
    {
        return News::where('id', $id)->increment('clicks');
    }
}
