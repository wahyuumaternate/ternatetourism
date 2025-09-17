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
        // Cek apakah IP ini sudah mengakses dalam 30 menit terakhir
        $existingVisit = Visitor::where('ip', $ip)
            ->where('created_at', '>=', $currentTime->copy()->subMinutes(30))
            ->first();

        // Jika belum ada kunjungan dalam 30 menit terakhir, baru catat
        if (!$existingVisit) {
            $ip = request()->ip();

            // Skip geolocation untuk local development
            if (app()->environment('local') || $ip == '127.0.0.1' || $ip == '::1' || $ip == '0.0.0.0') {
                // Langsung simpan visitor tanpa geolocation
                Visitor::create([
                    'ip' => $ip,
                    'user_agent' => $request->userAgent(),
                    'latitude' => null,
                    'longitude' => null,
                    'country' => 'Local',
                    'city' => 'Development',
                    'page_visited' => $request->path()
                ]);
            } else {
                // Production: jalankan geolocation dengan error handling
                try {
                    $response = Http::timeout(10)
                        ->retry(2, 3000)
                        ->get("http://ip-api.com/json/{$ip}");

                    $locationData = $response->json();

                    if ($response->successful() && isset($locationData['status']) && $locationData['status'] === 'success') {
                        Visitor::create([
                            'ip' => $ip,
                            'user_agent' => $request->userAgent(),
                            'latitude' => $locationData['lat'] ?? null,
                            'longitude' => $locationData['lon'] ?? null,
                            'country' => $locationData['country'] ?? null,
                            'city' => $locationData['city'] ?? null,
                            'page_visited' => $request->path()
                        ]);
                    } else {
                        // Fallback jika API gagal
                        Visitor::create([
                            'ip' => $ip,
                            'user_agent' => $request->userAgent(),
                            'latitude' => null,
                            'longitude' => null,
                            'country' => 'Unknown',
                            'city' => 'Unknown',
                            'page_visited' => $request->path()
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::warning('IP Geolocation failed: ' . $e->getMessage(), ['ip' => $ip]);

                    // Simpan visitor tanpa lokasi jika error
                    Visitor::create([
                        'ip' => $ip,
                        'user_agent' => $request->userAgent(),
                        'latitude' => null,
                        'longitude' => null,
                        'country' => 'Unknown',
                        'city' => 'Unknown',
                        'page_visited' => $request->path()
                    ]);
                }
            }
        }

        return $next($request);
    }
}
