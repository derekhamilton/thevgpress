<?php
namespace App\Services\Save\News;

use Illuminate\Http\Request;
use App\Queries\News\SaveNews;

class SaveService
{
    private $saveNews;

    public function __construct(SaveNews $saveNews)
    {
        $this->saveNews = $saveNews;
    }

    public function save(Request $request): \App\Models\News
    {
        $item = $this->saveNews->query($request->all(), $request->input('id'));
        $item->username = $item->user->username;
        return $item;
    }
}
