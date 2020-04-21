<?php
namespace JingBh\AutoZP\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JingBh\AutoZP\InviteCode;

class CheckInvite
{
    /**
     * 检查是否有正确的邀请码
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is("autozp/*") || InviteCode::isValid()) {
            return $next($request);
        } else return redirect("autozp/invite_code");
    }
}
