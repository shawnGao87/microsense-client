<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperationTest extends TestCase
{
    /** @test */
    public function can_get_operation_options()
    {
        /**
         * # Disabling Laravel layer of error handling
         */
        $this->withoutExceptionHandling();


        /**
         * # Get request from route fetching operation options
         */
        $response = $this->get("/operations");

        /**
         * # Assert status OK
         */
        $response->assertStatus(200);

        /**
         * # Assert response is an instance of response
         */
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response->baseResponse);



        $data = json_decode($response->getContent());


        /**
         * # Assert the data is an array
         */
        $this->assertIsArray($data);

        /**
         * # Assert there are operation options
         */
        $this->assertNotEmpty($data);
    }
}
