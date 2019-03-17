<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Services\Save\News\SaveService;
use App\Alerts\Alert;

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
