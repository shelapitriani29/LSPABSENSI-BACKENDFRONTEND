<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = User::normalizeRole(auth()->user()->role);
        $requiredRole = User::normalizeRole($role);

        $allowedRoles = match ($requiredRole) {
            'admin' => ['admin'],
            'asesor' => ['asesor', 'admin'],
            'peserta' => ['peserta', 'admin'],
            default => [$requiredRole],
        };

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}