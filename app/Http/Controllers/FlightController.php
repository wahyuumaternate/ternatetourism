<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class FlightController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $client = new \GuzzleHttp\Client();

        $origin = $request->get('origin', 'TTE');
        $destination = $request->get('destination', 'CGK');

        try {
            $response = $client->request('GET', 'https://agoda-travel.p.rapidapi.com/agoda-app/flight/search-one-way', [
                'headers' => [
                    'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                    'X-RapidAPI-Host' => 'agoda-travel.p.rapidapi.com',
                ],
                'query' => [
                    'origin' => $origin,
                    'destination' => $destination,
                    'locale' => 'id-ID',
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Get real-time USD to IDR rate
            $usdRate = $this->getUSDToIDRRate();

            $flights = collect($data['data']['bundles'] ?? [])->map(function ($bundle) use ($usdRate) {
                $priceData = $bundle['bundlePrice'][0]['price']['usd']['display']['perBook'] ?? null;
                $segment = $bundle['outboundSlice']['segments'][0] ?? null;
                $itineraryInfo = $bundle['itineraries'][0]['itineraryInfo'] ?? null;
                $freeBags = $bundle['outboundSlice']['freeBags'] ?? [];

                // Gunakan harga yang sudah final dari API
                $finalUSD = $priceData['allInclusive'] ?? 0;
                $baseUSD = $priceData['exclusive'] ?? 0;

                // Convert ke IDR dengan rate yang lebih konservatif (mendekati Agoda)
                $agodaRate = $usdRate * 0.98; // Agoda biasanya pakai rate sedikit lebih rendah
                $finalIDR = $finalUSD * $agodaRate;
                $baseIDR = $baseUSD * $agodaRate;

                // Jangan tambah platform fee lagi - harga API sudah termasuk markup

                // Generate booking URL
                $bookingUrl = $this->generateAgodaBookingUrl(
                    $itineraryInfo['id'] ?? '',
                    $itineraryInfo['token'] ?? ''
                );

                // Parse baggage information
                $carryOnBaggage = null;
                $checkedBaggage = null;

                foreach ($freeBags as $bag) {
                    if ($bag['baggageType'] === 'CARRY_ON') {
                        $weight = '';
                        $dimensions = '';

                        foreach ($bag['restrictions'] ?? [] as $restriction) {
                            if ($restriction['restrictionType'] === 'WEIGHT') {
                                $weight = $restriction['value'] . ' ' . strtolower($restriction['unit']);
                            }
                            if ($restriction['restrictionType'] === 'DIMENSION') {
                                $dimensions = str_replace('*', '×', $restriction['value']) . ' ' . strtolower($restriction['unit']);
                            }
                        }

                        $carryOnBaggage = [
                            'included' => $bag['quantity'] > 0,
                            'weight' => $weight,
                            'dimensions' => $dimensions,
                            'quantity' => $bag['quantity']
                        ];
                    }

                    if ($bag['baggageType'] === 'CHECKED') {
                        $weight = '';

                        foreach ($bag['restrictions'] ?? [] as $restriction) {
                            if ($restriction['restrictionType'] === 'WEIGHT') {
                                $weight = $restriction['value'] . ' ' . strtolower($restriction['unit']);
                            }
                        }

                        $checkedBaggage = [
                            'included' => $bag['quantity'] > 0,
                            'weight' => $weight,
                            'quantity' => $bag['quantity']
                        ];
                    }
                }

                return [
                    'airline' => $segment['carrierContent']['carrierName'] ?? '-',
                    'logo' => $segment['carrierContent']['carrierIcon'] ?? '-',
                    'flightNumber' => $segment['flightNumber'] ?? '-',
                    'departTime' => $segment['departDateTime'] ?? '-',
                    'arrivalTime' => $segment['arrivalDateTime'] ?? '-',
                    'total' => round($finalIDR),
                    'basePrice' => round($baseIDR),
                    'usdPrice' => $finalUSD,
                    'currency' => 'IDR',
                    'bookingUrl' => $bookingUrl,
                    'transit' => count($bundle['outboundSlice']['segments'] ?? []) > 1,
                    'carryOnBaggage' => $carryOnBaggage,
                    'checkedBaggage' => $checkedBaggage,
                    'originalData' => [
                        'usdFinal' => $finalUSD,
                        'usdBase' => $baseUSD,
                        'rate' => $agodaRate
                    ]
                ];
            });
        } catch (\Exception $e) {

            $flights = collect([]);
        }

        $airports = [
            'TTE' => 'Sultan Babullah Airport - Ternate',
            'CGK' => 'Soekarno-Hatta International Airport - Jakarta',
            'SUB' => 'Juanda International Airport - Surabaya',
            'DPS' => 'Ngurah Rai International Airport - Bali',
            'UPG' => 'Sultan Hasanuddin International Airport - Makassar',
            'KNO' => 'Kualanamu International Airport - Medan',
            'YIA' => 'Yogyakarta International Airport - Yogyakarta',
            'SRG' => 'Ahmad Yani Airport - Semarang',
            'SOC' => 'Adi Soemarmo Airport - Solo',
            'BDO' => 'Husein Sastranegara Airport - Bandung',
            'PLM' => 'Sultan Mahmud Badaruddin II Airport - Palembang',
            'PKU' => 'Sultan Syarif Kasim II Airport - Pekanbaru',
            'BPN' => 'Sultan Aji Muhammad Sulaiman Airport - Balikpapan',
            'MLG' => 'Abdul Rachman Saleh Airport - Malang',
            'AMQ' => 'Pattimura Airport - Ambon',
        ];

        return view('flights.index', compact('flights', 'origin', 'destination', 'airports'));
    }

    private function getUSDToIDRRate()
    {
        try {
            // Option 1: Use free currency API
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://api.exchangerate-api.com/v4/latest/USD');
            $rates = json_decode($response->getBody(), true);

            return $rates['rates']['IDR'] ?? 15500;
        } catch (\Exception $e) {
            // Fallback to manual rate or database
            return env('USD_TO_IDR', 15500);
        }
    }

    private function generateAgodaBookingUrl($itineraryId, $token)
    {
        if (empty($itineraryId) || empty($token)) {
            return '#';
        }

        $baseUrl = 'https://www.agoda.com/id-id/bookings/details';
        $params = [
            'cid' => '1915012',
            'itineraryId' => $itineraryId,
            'token' => $token
        ];

        return $baseUrl . '?' . http_build_query($params);
    }
}
