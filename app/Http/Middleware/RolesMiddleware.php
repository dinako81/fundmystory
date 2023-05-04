<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $roles = explode('|', $roles);
        
        $userRole = User::ROLES[$user->role];

        if (!in_array($userRole, $roles)) {
            abort(401);
        }
        
        // dump($roles);
        // dump($userRole);
        
        return $next($request);
    }
}