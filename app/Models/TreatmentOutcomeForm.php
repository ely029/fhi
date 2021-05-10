<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentOutcomeForm extends Model
{
    use HasFactory;

    protected $table = 'treatment_outcome_form';
    protected $fillable = [
        'tb_case_number',
        'date_started_treatment',
        'current_drug_susceptibility',
        'outcome',
    ];
}
