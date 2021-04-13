<?php

namespace Tests\Feature\RolesTest;

use App\Models\EnrollmentRegimentForm;
use App\Models\TBMacForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthCareWorkerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHealthCareWorkerCanCreateEnrollmentForm()
    {
        $healthCareWorker = User::factory()->create([
            'role_id' => '2',
        ]);

        $response = $this->actingAs($healthCareWorker)->post('/enrollment/create', [
            'patient_id' => 1,
            'status' => 'Enrolled',
            'region' => 'REGION 1',
            'role_id' => $healthCareWorker->role_id,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tb_mac_forms', [
            'submitted_by' => $healthCareWorker->id,
            'region' => 'REGION 1',
            'role_id' => $healthCareWorker->role_id,
        ]);
        
    }

    public function testEnrollmentFormTable(){

        $healthCareWorker = User::factory()->create([
            'role_id' => '2',
        ]);

        $tbMacForm = TBMacForm::factory()->create([
            'submitted_by' => $healthCareWorker->id,
            'status' => 'Enrolled',
            'patient_id' => 1,
            'region' => 'REGION 1',
            'form_type' => 'enrollment',
            'role_id' => $healthCareWorker->role_id,
        ]);

        $enrollmentForm = EnrollmentRegimentForm::factory()->create([
            'form_id' => $tbMacForm->id
        ]);

        $this->assertDatabaseHas('tb_mac_forms', [
            'id' => $tbMacForm->id,
            'region' => $tbMacForm->region,
            'role_id' => $healthCareWorker->role_id,
        ]);

        $this->assertDatabaseHas('enrollment_regiment_form', [
            'id' => $enrollmentForm->id,
            'form_id' => $tbMacForm->id
        ]);

    }
}
