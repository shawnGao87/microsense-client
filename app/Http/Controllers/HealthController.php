<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class HealthController extends Controller
{
    private $health;

    public function __construct()
    {
        $client = new Client();
        $res = $client->get('localhost:3000/health');
        $data = $res->getBody()->getContents();

        $this->health = $data;
    }
    public function index()
    {

        return $this->health;
    }
}
