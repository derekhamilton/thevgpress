<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\PageController;
use App\Services\Get\News\CurrentService;
use Illuminate\Http\Request;

final class CurrentController extends PageController
{
    /**
     * @param Request        $request
     * @param CurrentService $service
     * @return \Illuminate\View\View
     */
    public function show(
        Request $request,
        CurrentService $service
    ) {
        return view('news.current', $service->get($request)->all());
    }
}
