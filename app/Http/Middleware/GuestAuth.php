<?php

namespace App\Http\Middleware;

use Closure;

class GuestAuth extends Authenticate
{

    /**
     * Check if the user is logged in OR has the public_id of the project stored in a cookie
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->guest()){
            $route = $request->route()->parameters();
            $project = \DB::table('projects')->where('slug', $route['project'])->first();
            if($request->cookie('public_id') == null || 
               strtoupper($request->cookie('public_id')) != $project->public_id){
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect('/');
                }
            }
        }
        return $next($request);
    }
}
