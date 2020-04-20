<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\corona_api_model;
use \GuzzleHttp\Client;

class killcorona extends Controller
{
    public function dataDisplay()
    {
        $corona = corona_api_model::all();
        return response()->json($corona);
    }
    public function showData()
    {
        $corona = corona_api_model::all();
    }

    public function fetchData()
    {
        $client = new client();
        $request = $client->get("https://api.covid19api.com/summary");
        dd(json_decode($request->getBody()));
    }

    public function showFromApi()
    {
        $json = json_decode(file_get_contents('https://api.covid19api.com/summary'), true);
        //dd($json);
        return view('killcorona', compact('json'));
    }
}
