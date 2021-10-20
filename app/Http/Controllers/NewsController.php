<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    function getList() {
        $news = News::query()->where('is_published', '=' ,'1')
            ->where('published_at', '<=', 'now()')
            ->orderByDesc('published_at')
            ->paginate(5);

        return view('news', ['news'=>$news]);
    }

    function getDetails($slug) {
        $news_element = News::query()
            ->where('published_at', '<=', 'now()')
            ->where('slug', '=', $slug)->first();
        if ($news_element == null || !$news_element->is_published) {
            abort(404);
        }
        return view('news_item', ['item' => $news_element]);
    }
}
