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
        'current_bacteriological_status',
        'dst_from_other_lab',
        'tb_disease_classification',
        'current_weight',
        'suggested_regimen',
        'if_for_empiric_treatment',
    ];
}
