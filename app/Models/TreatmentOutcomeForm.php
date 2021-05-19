<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TreatmentOutcomeForm
 *
 * @property int $id
 * @property int $form_id
 * @property string $tb_case_number
 * @property string|null $date_started_treatment
 * @property string $current_drug_susceptibility
 * @property string $outcome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereCurrentDrugSusceptibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereDateStartedTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereTbCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
