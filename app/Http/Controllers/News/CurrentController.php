<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Services\Get\NewsCurrentService;

final class CurrentController extends PageController
{
    /**
     * @param Request            $request
     * @param NewsCurrentService $service
     * @return \Illuminate\View\View
     */
    public function show(
        Request $request,
        NewsCurrentService $service
    ) {
        return view('news.current', $service->get($request)->toArray());
    }
}
