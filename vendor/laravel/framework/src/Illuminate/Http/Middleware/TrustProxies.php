<?php

namespace Illuminate\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The proxy header mappings.
     *
     * @var int
     */
    protected $headers;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setTrustedProxyIpAddresses($request);

        return $next($request);
    }

    /**
     * Sets the trusted proxies on the request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function setTrustedProxyIpAddresses($request)
    {
        $request->setTrustedProxies(
            $this->proxies ?: [],
            $this->headers ?: SymfonyRequest::HEADER_X_FORWARDED_ALL
        );
    }
}
