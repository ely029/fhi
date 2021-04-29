<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaseManagementRegimentForm
 *
 * @property int $id
 * @property int $form_id
 * @property string $month_of_treatment
 * @property string $current_type_of_case
 * @property string $current_regiment
 * @property string $reason_case_management_presentation
 * @property string $current_weight
 * @property string $suggested_weight
 * @property string $updated_type_of_case
 * @property string $suggested_regimen
 * @property string $if_for_empiric_treatment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CaseManagementRegimentFormFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereCurrentRegiment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereCurrentTypeOfCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereCurrentWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereIfForEmpiricTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereMonthOfTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereReasonCaseManagementPresentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereSuggestedRegimen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereSuggestedWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementRegimentForm whereUpdatedTypeOfCase($value)
 * @mixin \Eloquent
 */
class CaseManagementRegimentForm extends Model
{
    use HasFactory;
    protected $table = 'case_management_regiment_form';

    protected $fillable = [
        'month_of_treatment',
        'current_type_of_case',
        'current_regiment',
        'reason_case_management_presentation',
        'current_weight',
        'suggested_weight',
        'updated_type_of_case',
        'suggested_regimen',
        'current_drug_susceptibility',
        'itr_drugs',
        'suggested_regimen_notes',
    ];
}
