<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class ReaderController extends Controller
{
    private $readers;
    private $res;


    public function __construct()
    {
        $client = new Client();

        $res = $client->get('localhost:3000/readers');

        $readers = $res->getBody()->getContents();
        $this->readers = $readers;

        /**
         * ! Combining Readers with Health togethe
         */
        $readers_arr = array_column(json_decode($readers, true), null, 'name');
        $health_arr = array_column(json_decode(app('App\Http\Controllers\HealthController')->index(), true), null, 'reader');
        $result = array_merge_recursive($readers_arr, $health_arr);

        /**
         * ! Also fetching Operation Options data from OperationController for Frontend use
         */
        $this->res = new \stdClass;
        $this->res->operations = app('App\Http\Controllers\OperationController')->index();
        $this->res->readers_and_health = $result;
    }



    public function getReaders()
    {
        return response()->json($this->res);
    }


    public function index()
    {
        $readers = $this->res;
        return view('index', compact('readers'));
    }
}
