<?php
namespace App\Queries\Forum\Board;

use App\Models\ForumBoard;

class FindBySlug
{
    public function query($slug)
    {
        return ForumBoard::where('slug', $slug)->first();
    }
}
