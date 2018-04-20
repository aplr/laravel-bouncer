<?php 

namespace Aplr\Bouncer;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Bounce
{
    /** @var Bouncer $bouncer */
    protected $bouncer;

    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $request->header('X-API-KEY', null);

        if (is_null($key)) {
            throw new UnauthorizedHttpException("You need to provide an api key.", "Unauthorized.");
        }

        if (!$this->bouncer->check($key)) {
            throw new UnauthorizedHttpException("Invalid api key.", "Unauthorized.");
        }

        return $next($request);
    }
}