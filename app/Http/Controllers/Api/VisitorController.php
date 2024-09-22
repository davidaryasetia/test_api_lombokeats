<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorResource;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        // Get location data from IP address
        $locationData = $this->getLocationFromIp($ipAddress);
        $visitDateTime = Carbon::now($locationData['timezone']);
        $visitDate = $visitDateTime->toDateString();


        // If no record exists for this IP on the current day, create a new one
            $visitor = Visitor::create([
                'visit_date' => $visitDateTime,
                'ip_address' => $ipAddress,
                'city' => $locationData['city'],
                'country' => $locationData['country'],
                'region' => $locationData['region'],
                'timezone' => $locationData['timezone'],
                'latitude' => $locationData['latitude'],
                'longitude' => $locationData['longitude'],
            ]);

        return new VisitorResource($visitor);
    }

    // Fungsi GetLocation IP Address dengan IP Info
    private function getLocationFromIp($ip)
    {
        $response = Http::get("https://ipinfo.io/{$ip}?token=12d62dc0bbfec9");
        if ($response->successful()) {

            // dapatkan latitude dan logitude
            $location = $response->json()['loc'] ?? '0,0';
            $locationParts = explode(',', $location);

            return [
                'city' => $response->json()['city'] ?? 'Unknown City',
                'country' => $response->json()['country'] ?? 'Unknown Country',
                'region' => $response->json()['region'] ?? 'Unknown Region',
                'timezone' => $response->json()['timezone'] ?? 'UTC',
                'latitude' => $locationParts[0] ?? '0',
                'longitude' => $locationParts[1] ?? '0',
            ];
        }

        return [
            'city' => 'Unknown City',
            'country' => 'Unknown Country',
            'region' => 'Unknown Region',
            'timezone' => 'Unknown Timezone',
            'latitude' => '0',
            'longitude' => '0'
        ];
    }
}
