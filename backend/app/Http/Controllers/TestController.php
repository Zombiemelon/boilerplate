<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testApi()
    {
        $apiUrl = env('TEST_API');
        $url = "$apiUrl/testApi";
        $client = new Client();
        $response = $client->request('POST',$url);
        return $response->getBody();
    }
}
