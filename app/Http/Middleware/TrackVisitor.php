<?php

// Dalam TrackVisitor.php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $currentTime = now();
        dd($request->ip());
        // Cek apakah IP ini sudah mengakses dalam 30 menit terakhir
        $existingVisit = Visitor::where('ip', $ip)
            ->where('created_at', '>=', $currentTime->copy()->subMinutes(30))
            ->first();

        // Jika belum ada kunjungan dalam 30 menit terakhir, baru catat
        if (!$existingVisit) {
            $response = Http::get("http://ip-api.com/json/{$ip}");
            $locationData = $response->json();

            if($response->successful()) {
                Visitor::create([
                    'ip' => $ip,
                    'user_agent' => $request->userAgent(),
                    'latitude' => $locationData['lat'] ?? null,
                    'longitude' => $locationData['lon'] ?? null,
                    'country' => $locationData['country'] ?? null,
                    'city' => $locationData['city'] ?? null,
                    'page_visited' => $request->path()
                ]);
            }
        }

            return $next($request);
    }
}