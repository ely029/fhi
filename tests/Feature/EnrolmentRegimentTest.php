<?php

namespace Tests\Feature;

use App\Models\EnrolmentRegimentForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory;
use Tests\TestCase;

class EnrolmentRegimentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Create Enrolment Regiment.
     *
     * @return void
     */
    public function create()
    {
        $response = $this->json('POST','/enrolment/create', [
            'submitted_by' => 1,
            'patient_id' => 1,
            'status' => 'Enrolled',
            'level' => 'REGIONAL',
            'approved_by' => 1,
            'region' => 'REGION 1',
            'role_id' => 1,
        ]);

        $response->assertStatus(200);
    }
}
