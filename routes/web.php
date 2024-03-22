<?php

use Illuminate\Support\Facades\Route;
use Cache;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itunes', function (Request $request) {

    $term = urlencode('Emancipator'); 
    $cacheKey = "itunes-api-$term";
    $seconds = 60;

    $response = Cache::remember($cacheKey, $seconds, function () use ($term) {
        return Http::get("https://itunes.apple.com/search?term=$term")->object();
    });

    return view('api.itunes', [
        'response' => $response,
    ]);
});

Route::get('/yelp', function () {
    $queryString = http_build_query([
        'term' => 'vegan',
        'location' => 'Los Angeles',
    ]);

    // We can set headers for our request using withHeaders
    // https://laravel.com/docs/11.x/http-client#headers
    return Http::withHeaders([
        'Authorization' => "Bearer " . env('YELP_API_KEY')
    ])
        ->get("https://api.yelp.com/v3/businesses/search?$queryString")
        ->json();

    // OR you can use withToken to set the Authorization header
    // https://laravel.com/docs/11.x/http-client#bearer-tokens
    return Http::withToken(env('YELP_API_KEY'))
        ->get("https://api.yelp.com/v3/businesses/search?$queryString")
        ->json();
});
