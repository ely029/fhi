<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBMacForm extends Model
{
    use HasFactory;
    
    protected $table = 'tb_mac_forms';

    protected $fillable = [
        'submitted_by','form_type','patient_id','status','role_id','region'
    ];

    public function enrollmentForm()
    {
        return $this->hasOne(EnrollmentRegimentForm::class,'form_id');
    }
}
