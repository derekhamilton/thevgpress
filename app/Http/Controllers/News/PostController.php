<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\PageController;
use App\Services\Save\News\SaveService;
use Illuminate\Http\Request;

final class PostController extends PageController
{
    public function post(Request $request, SaveService $service)
    {
        $item = $service->save($request);
        $this->alert->success("Your submission has been saved");
        $this->alert->datum(view('news.item', ['item' => $item]));
        return $this->response(null, false);
    }
}
