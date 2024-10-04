<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('code')) {
            $url = 'https://foursquare.com/oauth2/access_token?client_id=' . env('FOURSQUARE_CLIENT_ID') . '&client_secret=' . env('FOURSQUARE_CLIENT_SECRET') . '&grant_type=authorization_code&redirect_uri=' . env('FOURSQUARE_REDIRECT_URI') . '&code=' . $request->get('code');

            $response = Http::get($url);
            $token = $response->json();
            if ($token && !array_key_exists('error', $token)) {
                Cache::remember('access_token', 86400, function () use ($token) {
                    return $token['access_token'];
                });

                return redirect()->route('home');
            }
        }

        $access_code = Cache::get('access_token');
        if (!$access_code) {
            $url = 'https://foursquare.com/oauth2/authenticate?client_id=MHBBCVJMLWUAT0U4VWYFH0C4T5WZVMJJGPFU1VZIAZAUDUEJ&response_type=code&redirect_uri=http://127.0.0.1:8000/';
            return Inertia::render('Login', [
                'foursquare_url' => $url,
            ]);
        } else {
            return redirect()->route('home');
        }
    }
}
