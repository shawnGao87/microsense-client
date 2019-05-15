<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HealthTest extends TestCase
{


    /** @test */
    public function can_get_health_status()
    {
        /**
         * # Disabling Laravel layer of error handling
         */
        $this->withoutExceptionHandling();


        /**
         * # Get request from route fetching operation options
         */
        $response = $this->get("/health");

        /**
         * # Assert status OK
         */
        $response->assertStatus(200);
        $data = json_decode($response->getContent());


        /**
         * # Assert response is an instance of response
         */
        $this->assertInstanceOf('Illuminate\Http\Response', $response->baseResponse);



        /**
         * # Assert the data is an array (could be empty)
         */
        $this->assertIsArray($data);

        /**
         * # If not empty, assert each entry has required keys
         */
        if (!empty($data)) {
            foreach ($data as  $h) {
                $this->assertObjectHasAttribute("reader", $h);
                $this->assertObjectHasAttribute("status", $h);
                $this->assertObjectHasAttribute("message", $h);
            }
        }
    }
}
