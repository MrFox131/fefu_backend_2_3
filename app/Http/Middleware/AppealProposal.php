<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class AppealProposal
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
        if (!$request->session()->has('next_appeal_proposal')){
            $request->session()->put('next_appeal_proposal', now()->addMinutes(config('setting.appealInterval')));
            $request->session()->put('appeal_count', 0);
            $request->session()->put('appeal_submitted', false);
            return $next($request);
        }
        if (now()->gt($request->session()->get('next_appeal_proposal')) &&
            !$request->session()->get('appeal_submitted') &&
            $request->session()->get('appeal_count') < config('setting.appealCount')){

            $request->session()->put('next_appeal_proposal', now()->addMinutes(config('setting.appealInterval')));
            $request->session()->put('appeal_count', $request->session()->get('appeal_count')+1);
            return redirect(route('appeal'))->with(['prev_url'=>'/'.$request->path(), 'isRedirect' => true]);
        }
        return $next($request);

    }
}
