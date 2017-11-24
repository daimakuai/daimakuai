<?php

namespace Jblv\Admin\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jblv\Admin\Auth\Database\OperationLog as OperationLogModel;
use Jblv\Admin\Facades\Admin;

class LogOperation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            $log = [
                'user_id' => Admin::user()->id,
                'path' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->getClientIp(),
                'input' => json_encode($request->input()),
            ];

            OperationLogModel::create($log);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldLogOperation(Request $request)
    {
        return config('admin.operation_log.enable')
            && !$this->inExceptArray($request)
            && Admin::user();
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach (config('admin.operation_log.except') as $except) {
            if ('/' !== $except) {
                $except = trim($except, '/');
            }

            $methods = [];

            if (Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) &&
                (empty($methods) || in_array($request->method(), $methods, true))) {
                return true;
            }
        }

        return false;
    }
}
