<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class RedirectFromOldSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->segment(2);

        $newSlug = $url;
        $redirect = Redirect::where('old_slug', $url)->orderByDesc('created_at')->orderByDesc('id')->first();


        while ($redirect !== null) {
            $newSlug = $redirect->new_slug;
            $redirect = Redirect::where('old_slug', $newSlug)->where('created_at', '>', $redirect->created_at)->orderByDesc('created_at')->orderByDesc('id')->first();
        }
        if ($newSlug !== $url) {
            return redirect()->route('news_item', ['slug' => $newSlug]);
        }

        return $next($request);
    }
}
