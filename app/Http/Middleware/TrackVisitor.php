<?php

namespace App\Http\Middleware;

use App\Contracts\Interfaces\VisitorLogRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function __construct(
        protected VisitorLogRepositoryInterface $visitorLogRepository
    ) {}

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Record the visitor asynchronously (non-blocking)
        $ip = $request->ip();
        $page = $request->path();

        // Record visitor - firstOrCreate handles deduplication
        $this->visitorLogRepository->recordVisitor($ip, $page);

        return $next($request);
    }
}
