<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnforceSessionSecurity
{
    public function handle(Request $request, Closure $next)
    {
        $idleTimeout = config('session.idle_timeout');
        $absoluteTimeout = config('session.absolute_timeout');
        $now = Carbon::now()->timestamp;

        $lastActivity = $request->session()->get('last_activity');
        $firstLogin = $request->session()->get('first_login');

        if (!$firstLogin) {
            $request->session()->put('first_login', $now);
        }

        if ($idleTimeout && $lastActivity && ($now - $lastActivity) > ($idleTimeout * 60)) {
            $this->logout($request);
            return redirect()->route('login')->withErrors('Sesi berakhir karena idle melebihi batas.');
        }

        if ($absoluteTimeout && $firstLogin && ($now - $firstLogin) > ($absoluteTimeout * 60)) {
            $this->logout($request);
            return redirect()->route('login')->withErrors('Sesi berakhir karena melebihi batas waktu maksimum.');
        }

        $request->session()->put('last_activity', $now);

        return $next($request);
    }

    protected function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
