<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function GuzzleHttp\json_encode;

class OperationController extends Controller
{

    private $operationOptions;

    public function __construct()
    {
        $client = new Client();

        $res = $client->get('localhost:3000/operations');

        $data = $res->getBody()->getContents();
        $this->operationOptions = json_decode($data);
    }

    public function index()
    {
        return $this->operationOptions;
    }
}
