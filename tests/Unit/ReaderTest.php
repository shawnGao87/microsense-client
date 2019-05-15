<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReaderTest extends TestCase
{
    /** @test */
    public function can_get_readers()
    {
        /**
         * # Disabling Laravel layer of error handling
         */
        $this->withoutExceptionHandling();


        /**
         * # Get request from route fetching readers
         */
        $response = $this->get("/readers");

        /**
         * # Assert status OK
         */
        $response->assertStatus(200);

        /**
         * # Assert response is an instance of JSON response
         */
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response->baseResponse);


        $data = json_decode($response->getContent());


        /**
         * # Assert the data is an array
         */
        $this->assertIsObject($data);

        /**
         * # Assert there are readers
         */
        $this->assertNotEmpty($data);


        /**
         * ! In the ReaderController, Operations, Healther and Readers are combined 
         */
        $this->assertObjectHasAttribute('readers_and_health', $data);
        $this->assertObjectHasAttribute('operations', $data);
    }

    /** @test */
    public function can_get_to_homepage_ok()
    {
        $res = $this->get('/');
        $res->assertOk();
        $res->assertSee("MicroSense");
    }

    /** @test */
    public function can_post_to_create_jobs()
    {
        $res = $this->post('/jobs');

        /**
         * * The JobController will do some data validattion
         * * and will return non 200 status if error
         */
        $res->assertOk();
    }
}
