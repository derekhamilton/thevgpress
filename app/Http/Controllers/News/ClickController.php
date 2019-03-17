<?php
namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Queries\News\ClickNews;

final class ClickController extends BaseController
{
    public function click(Request $request, ClickNews $clickNews): void
    {
        $clickNews->query($request->input('id'));
    }
}
