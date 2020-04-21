<?php
namespace JingBh\AutoZP\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use JingBh\AutoZP\AutoZPUser;

class LoadUser
{
    /**
     * 加载 AutoZPUser 类
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @see AutoZPUser
     */
    public function handle(Request $request, Closure $next) {
        $user = AutoZPUser::getTokenFromSession();
        View::share("autozp_user", $user);
        return $next($request);
    }
}
