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
            ->orderByDesc('id')
            ->paginate(5);

        return view('news', ['news'=>$news]);
    }

    function getDetails($slug) {
        $news_element = News::query()
            ->where('slug', '=', $slug)->first()
            ->where('published_at', '<=', 'NOW()')
            ->where('is_published', '=', 'true');

        if ($news_element === null) {
            abort(404);
        }
        return view('news_item', ['item' => $news_element]);
    }
}
