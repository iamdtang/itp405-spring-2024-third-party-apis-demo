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
