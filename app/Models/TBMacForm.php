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
 * @property-read \App\Models\CaseManagementAttachments $caseManagementAttachment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementAttachments[] $caseManagementAttachments
 * @property-read int|null $case_management_attachments_count
 * @property-read \App\Models\CaseManagementBacteriologicalResults $caseManagementBacteriologicalResult
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementBacteriologicalResults[] $caseManagementBacteriologicalResults
 * @property-read int|null $case_management_bacteriological_results_count
 * @property-read \App\Models\CaseManagementRegimentForm|null $caseManagementForm
 * @property-read \App\Models\CaseManagementLaboratoryResults $caseManagementLaboratoryResult
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementLaboratoryResults[] $caseManagementLaboratoryResults
 * @property-read int|null $case_management_laboratory_results_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementBacteriologicalResults[] $dst
 * @property-read int|null $dst_count
 * @property-read \App\Models\EnrollmentRegimentForm|null $enrollmentForm
 * @property-read \App\Models\LaboratoryResult|null $laboratoryResults
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementBacteriologicalResults[] $lpa
 * @property-read int|null $lpa_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $ntbMacRecommendations
 * @property-read int|null $ntb_mac_recommendations_count
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Recommendation $recommendation
 * @property-read \App\Models\TreatmentOutcomeForm $treatmentOutcomeForm
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $regionalRecommendations
 * @property-read int|null $regional_recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $rtbMacRecommendations
 * @property-read int|null $rtb_mac_recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementBacteriologicalResults[] $screenOne
 * @property-read int|null $screen_one_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseManagementBacteriologicalResults[] $screenTwo
 * @property-read int|null $screen_two_count
 * @property-read \App\Models\User $submittedBy
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm caseManagementForms()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm enrollmentForms()
 * @method static \Database\Factories\TBMacFormFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacForm filter(\App\Models\Filters\TBMacFormFilters $filters)
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
    public const PRESENTATION_NUMBER = [
        'enrollment' => 'E-',
        'case_management' => 'C-',
        'treatment_outcome' => 'T-',
    ];
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

    public function treatmentOutcomeForm()
    {
        return $this->hasOne(TreatmentOutcomeForm::class, 'form_id');
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

    public function caseManagementAttachments()
    {
        return $this->hasMany(CaseManagementAttachments::class, 'form_id');
    }

    public function caseManagementAttachment()
    {
        return $this->belongsTo(CaseManagementAttachments::class, 'form_id');
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class, 'form_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'form_id');
    }

    public function regionalRecommendations()
    {
        return $this->hasMany(Recommendation::class, 'form_id')
            ->whereIn('role_id', [3,4,6]);
    }

    public function rtbMacRecommendations()
    {
        return $this->hasMany(Recommendation::class, 'form_id')
            ->whereIn('role_id', [3,4,5,6,8]);
    }

    public function ntbMacRecommendations()
    {
        return $this->hasMany(Recommendation::class, 'form_id')
            ->whereIn('role_id', [3,6,7,8]);
    }

    public function caseManagementForm()
    {
        return $this->hasOne(CaseManagementRegimentForm::class, 'form_id');
    }

    public function caseManagementLaboratoryResult()
    {
        return $this->hasOne(CaseManagementLaboratoryResults::class, 'form_id');
    }

    public function caseManagementLaboratoryResults()
    {
        return $this->hasMany(CaseManagementLaboratoryResults::class, 'form_id');
    }

    public function caseManagementBacteriologicalResult()
    {
        return $this->belongsTo(CaseManagementBacteriologicalResults::class, 'form_id');
    }

    public function caseManagementBacteriologicalResults()
    {
        return $this->hasMany(CaseManagementBacteriologicalResults::class, 'form_id');
    }

    public function screenOne()
    {
        return $this->hasOne(CaseManagementBacteriologicalResults::class, 'form_id')
            ->where('label', 'Screening 1')
            ->where('smear_microscopy', '')
            ->where('tb_lamp', '')
            ->where('culture', '');
    }

    public function monthlyScreening()
    {
        return $this->hasMany(CaseManagementBacteriologicalResults::class, 'form_id')
            ->where('smear_microscopy', '<>', '')
            ->where('tb_lamp', '<>', '')
            ->where('culture', '<>', '');
    }

    public function screenTwo()
    {
        return $this->hasOne(CaseManagementBacteriologicalResults::class, 'form_id')
            ->where('label', 'Screening 2')
            ->where('smear_microscopy', '')
            ->where('tb_lamp', '')
            ->where('culture', '');
    }

    public function lpa()
    {
        return $this->hasOne(CaseManagementBacteriologicalResults::class, 'form_id')
            ->where('label', 'LPA');
    }

    public function dst()
    {
        return $this->hasOne(CaseManagementBacteriologicalResults::class, 'form_id')
            ->where('label', 'DST')
            ->where('smear_microscopy', '');
    }

    public function treatmentOutcomeBacteriologicalResults()
    {
        return $this->hasMany(TreatmentOutcomeBacteriologicalResult::class, 'form_id');
    }

    public function scopeEnrollmentForms($query)
    {
        return $query->where('form_type', 'enrollment');
    }

    public function scopeCaseManagementForms($query)
    {
        return $query->where('form_type', 'case_management');
    }

    public function scopeTreatmentOutcomeForms($query)
    {
        return $query->where('form_type', 'treatment_outcome');
    }

    public function scopeFilter($query, TBMacFormFilters $filters)
    {
        return $filters->apply($query);
    }

    public function getPresentationNumberAttribute($value)
    {
        $prefix = self::PRESENTATION_NUMBER[$this->form_type];
        return $prefix.$value;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $presentationNumber = null;
            $max = TBMacForm::where('form_type', '=', $model->form_type)
                ->where('region', $model->region)->count();
            $presentationNumber = $model->region.'-'.str_pad(strval($max), 4, '0', STR_PAD_LEFT);
            $model->presentation_number = $presentationNumber;
            $model->save();
        });
    }
}
