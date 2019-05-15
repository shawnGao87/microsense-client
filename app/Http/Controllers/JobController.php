<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class JobController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();


        /**
         * ? If no reader is selected 
         */
        if (!isset($data['readers'])) {
            return redirect('/')->setStatusCode(400)->withErrors(['reader_select' => 'No Reader Selected']);
        }


        /**
         * ? If reader(s) is selected but no operation is selected
         */
        // dd($data);
        $readers = $data['readers'];
        $no_op_selected_err = [];
        foreach ($readers as $reader_name => $checked) {
            if (!isset($data['operations'][$reader_name])) {
                $no_op_selected_err[$reader_name] = $reader_name . ' Needs An Operation';
            }
        }
        if (!empty($no_op_selected_err)) {
            return redirect('/')->setStatusCode(400)->withErrors($no_op_selected_err);
        }





        /**
         * ? If operation is selected but no reader selected
         */

        $operations = $data['operations'];
        $no_reader_selected_err = [];

        foreach ($operations as $reader_name => $operation) {
            if (!isset($data['readers'][$reader_name])) {
                $no_reader_selected_err[$reader_name] = $reader_name . ' was not selected';
            }
        }

        if (!empty($no_reader_selected_err)) {
            return redirect('/')->setStatusCode(400)->withErrors($no_reader_selected_err);
        }




        /**
         * * Have both checkbox and operation selected
         * * $readers and $operations are previously defined
         */
        $jobs = [];

        foreach ($readers as $reader_name => $checked) {
            $jobs[$reader_name] = $operations[$reader_name];
        }

        // HERE WE CAN PERFORM THE POST
        $client = new Client();
        $client->post('localhost:3000', [
            RequestOptions::JSON => $jobs
        ]);

        return redirect('/')->with('jobs', $jobs)->setStatusCode(200);
    }
}
