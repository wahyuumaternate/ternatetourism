<?php

// Dalam TrackVisitor.php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $currentTime = now();
        
        // Tambahkan logging untuk debugging
        Log::info('IP Address: ' . $ip);
        
        $existingVisit = Visitor::where('ip', $ip)
            ->where('created_at', '>=', $currentTime->copy()->subMinutes(30))
            ->first();
    
        if (!$existingVisit) {
            try {
                $response = Http::get("http://ip-api.com/json/{$ip}");
                $locationData = $response->json();
                
                Log::info('API Response: ' . json_encode($locationData));
    
                if($response->successful()) {
                    $visitor = Visitor::create([
                        'ip' => $ip,
                        'user_agent' => $request->userAgent(),
                        'latitude' => $locationData['lat'] ?? null,
                        'longitude' => $locationData['lon'] ?? null,
                        'country' => $locationData['country'] ?? null,
                        'city' => $locationData['city'] ?? null,
                        'page_visited' => $request->path()
                    ]);
                    
                    Log::info('Visitor created: ' . $visitor->id);
                }
            } catch (\Exception $e) {
                Log::error('Error creating visitor: ' . $e->getMessage());
            }
        }
    
        return $next($request);
    }
}