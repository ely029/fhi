<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Filters\TBMacFormFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TBMacForm
 *
 * @property int $id
 * @property string|null $presentation_number
 * @property int $submitted_by
 * @property string $form_type
 * @property int $patient_id
 * @property string $status
 * @property string $level
 * @property int|null $approved_by
 * @property string $region
 * @property int $role_id
 * @property int|null $linked_tb_mac_form
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TBMacFormAttachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BacteriologicalResult[] $bacteriologicalResults
 * @property-read int|null $bacteriological_results_count
 * @property-read \App\Models\CaseManagementRegimentForm|null $caseManagementRegimentForm
 * @property-read EnrollmentRegimentForm|null $enrollmentForm
 * @property-read \App\Models\LaboratoryResult|null $laboratoryResults
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\User $submittedBy
 * @property object $recommendations
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm enrollmentForms()
 * @method static \Database\Factories\TBMacFormFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereFormType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereLinkedTbMacForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm wherePresentationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereSubmittedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TBMacForm extends Model
{
    use HasFactory;
    protected $table = 'tb_mac_forms';

    protected $fillable = [
        'submitted_by',
        'form_type','patient_id','status','role_id','region','presentation_number',
    ];

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function enrollmentForm()
    {
        return $this->hasOne(EnrollmentRegimentForm::class, 'form_id');
    }

    public function caseManagementRegimentForm()
    {
        return $this->hasOne(CaseManagementRegimentForm::class, 'form_id');
    }

    public function bacteriologicalResults()
    {
        return $this->hasMany(BacteriologicalResult::class, 'form_id');
    }

    public function laboratoryResults()
    {
        return $this->hasOne(LaboratoryResult::class, 'form_id');
    }

    public function attachments()
    {
        return $this->hasMany(TBMacFormAttachment::class, 'form_id');
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class, 'form_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'form_id');
    }

    public function scopeEnrollmentForms($query)
    {
        return $query->where('form_type', 'enrollment');
    }

    public function scopeCaseManagementForms($query)
    {
        return $query->where('form_type', 'case_management');
    }

    public function scopeFilter($query, TBMacFormFilters $filters)
    {
        return $filters->apply($query);
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $presentationNumber = null;
            if ($model->form_type === 'enrollment') {
                $max = TBMacForm::where('form_type', '=', 'enrollment')
                    ->where('region', $model->region)->count();
                $presentationNumber = $model->region.'-'.str_pad(strval($max), 4, '0', STR_PAD_LEFT);
            }
            $model->presentation_number = $presentationNumber;
            $model->save();
        });
    }
}
