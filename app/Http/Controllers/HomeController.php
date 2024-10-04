<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $code = $request->get('code');

        // if ($code) {
        //     $url = 'https://foursquare.com/oauth2/access_token?client_id=' . env('FOURSQUARE_CLIENT_ID') . '&client_secret=' . env('FOURSQUARE_CLIENT_SECRET') . '&grant_type=authorization_code&redirect_uri=' . env('FOURSQUARE_REDIRECT_URI') . '&code=' . $code;

        //     $response = Http::get($url);
        //     $access_token = $response->json();
        //     if ($access_token && !array_key_exists('error', $access_token)) {
        //         info($access_token);
        //         if ($request->input('search')) {
        //         }

        //         return Inertia::render('Home', [
        //             'foursquare_access_token' => (array_key_exists('access_token', $access_token) ? $access_token['access_token'] : null),
        //             'places' => null,
        //             'searched' => ($request->has('search') ? $request->input('search') : ''),
        //         ]);
        //     }
        // }

        $access_token = Cache::get('access_token');

        if ($access_token) {
            $data = [];
            if ($request->has('search')) {
                $url = 'https://api.foursquare.com/v2/venues/trending?v=' . now()->format('Ymd') . '&near=' . $request->get('search') . '&oauth_token=' . $access_token;
                $response = Http::get($url);
                if ($response->ok()) {
                    $json = $response->json();
                    $geocode = $json['response']['geocode'];
                    if ($geocode) {
                        $weather_url = 'https://api.openweathermap.org/data/2.5/forecast?q=' . $geocode['feature']['name'] . ',' . $geocode['feature']['cc'] . '&appId=' . env('OPENWEATHER_API_KEY') . '&units=metric';
                        $weather_response = Http::get($weather_url);
                        $data = $weather_response->json();
                    }
                }
            }

            // if ($data) {
            //     dd($data);
            // }

            return Inertia::render('Home', [
                'search' => $request->has('search') ? $request->get('search') : '',
                'places' => null,
                'data' => array_key_exists('city', $data) ? $data : null,
            ]);
        } else {
            return redirect()->route('login');
        }
        // return Redirect::to('https://foursquare.com/oauth2/authenticate?client_id=MHBBCVJMLWUAT0U4VWYFH0C4T5WZVMJJGPFU1VZIAZAUDUEJ&response_type=code&redirect_uri=http://127.0.0.1:8000/');
    }
}
