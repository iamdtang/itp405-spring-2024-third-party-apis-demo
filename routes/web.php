<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itunes', function (Request $request) {

    $term = urlencode('Iya Terra');
    $response = Http::get("https://itunes.apple.com/search?term=$term");

    // dd($response->object());

    return view('api.itunes', [
        'response' => $response->object(),
    ]);
});
