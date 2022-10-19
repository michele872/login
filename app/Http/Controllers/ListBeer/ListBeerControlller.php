<?php

namespace App\Http\Controllers\ListBeer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ListBeerControlller extends Controller
{
    public function index(Request $request) {
        $token = $request->session()->get('_token', 'default');

        try {
            $response = Http::accept('application/json')->get('https://api.punkapi.com/v2/beers', [
                'token' =>$token,
                'abv_lt' => 10,
            ]);
            //$response = Http::accept('application/json')->get('https://api.punkapi.com/v2/beers');

            //$list = $response->body();
            $list = json_decode($response->body(), true);
            return view('list_beer', [
                'list' => $list
            ]);
        } catch (\Throwable $e) {

        }
    }
}
