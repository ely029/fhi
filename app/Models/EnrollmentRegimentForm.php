<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentRegimentForm extends Model
{
    use HasFactory;

    protected $table = 'enrollment_regiment_form';
    protected $fillable = [
        'treatment_history',
        'registration_group',
        'risk_factor',
        'drug_susceptibility',
        'current_weight',
        'suggested_regimen',
        'suggested_regimen_other','regimen_notes','clinical_status','signs_and_symptoms','vital_signs',
        'diag_and_lab_findings'
    ];
}
