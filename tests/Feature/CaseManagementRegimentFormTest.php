<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TBMacForm;
use App\Models\CaseManagementRegimentForm;

class CaseManagementRegimentFormTest extends TestCase
{
    /**
     * Create a Case Management Regiment Form.
     *
     * @return void
     */
    public function testCaseManagementRegimentTableForm()
    {
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

        $caseManagementRegimentForm = CaseManagementRegimentForm::factory()->create([
            'form_id' => $tbMacForm->id,
            'suggested_regimen_notes' => '',
        ]);

        $this->assertDatabaseHas('tb_mac_forms', [
            'id' => $tbMacForm->id,
            'region' => $tbMacForm->region,
            'role_id' => $healthCareWorker->role_id,
        ]);

        $this->assertDatabaseHas('case_management_regiment_form', [
            'id' => $caseManagementRegimentForm->id,
            'form_id' => $tbMacForm->id
        ]);
    }
}
