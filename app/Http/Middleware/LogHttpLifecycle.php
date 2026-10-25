<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogHttpLifecycle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. リクエスト受信時（コントローラー実行前）のログ 
        \Log::info('==== Request received ===', [
            'method' => $request->method(),
            'url'    => $request->url(),
            'input'  => $request->all(),
            
        ]);

        // 2. コントローラーの処理を実行
        $response = $next($request);
        
        // 3. レスポンス返却時（コントローラー実行後）のログ 
        \Log::info('=== Response sent ===',[
            'status => $response->status(),'
        ]);
        
        return $response;

    }
}
