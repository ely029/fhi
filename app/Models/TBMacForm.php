<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EnrollmentRegimentForm;

class TBMacForm extends Model
{
    use HasFactory;
    protected $table = 'tb_mac_forms';

    protected $fillable = [
        'submitted_by','form_type','patient_id','status','role_id','region','presentation_number'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {

            $presentationNumber = null;
            if($model->form_type == 'enrollment'){
                $max = EnrollmentRegimentForm::count();
                $presentationNumber = $model->region.'-'.str_pad(strval($max + 1),3,"0",STR_PAD_LEFT);
            }
            $model->presentation_number = $presentationNumber;
            $model->save();

        });
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class,'submitted_by');
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

    public function scopeEnrollmentForms($query)
    {
        return $query->where('form_type','enrollment');
    }
}
