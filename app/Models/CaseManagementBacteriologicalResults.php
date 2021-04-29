<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseManagementBacteriologicalResults extends Model
{
    use HasFactory;

    protected $table = 'case_management_bacteriological_results';

    protected $fillable = [
        'form_id',
        'label',
        'date_collected',
        'resistance_pattern',
        'method_used',
        'smear_microscopy',
        'tb_lamp',
        'culture',
    ];

    protected $dates = [
        'date_collected',
    ];

    public function lpaCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'LPA',
            'date_collected' => ! isset($request['date_collected_lpa']) ? Carbon::now()->timestamp : $request['date_collected_lpa'],
            'resistance_pattern' => ! isset($request['resistance_pattern_lpa']) ? '' : $request['resistance_pattern_lpa'],
            'method_used' => ! isset($request['method_used_lpa']) ? '' : $request['method_used_lpa'],
            'form_id' => $form->id,
        ]);
    }

    public function dstCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'DST',
            'date_collected' => ! isset($request['date_collected_dst']) ? Carbon::now()->timestamp : $request['date_collected_dst'],
            'resistance_pattern' => ! isset($request['resistance_pattern_dst']) ? '' : $request['resistance_pattern_dst'],
            'method_used' => ! isset($request['method_used_dst']) ? '' : $request['method_used_dst'],
            'form_id' => $form->id,
        ]);
    }

    public function monthDSTCreation($screen, $eee, $request, $form)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'Screening '. $screen,
            'date_collected' => ! isset($request['date_collected'][$eee]) ? Carbon::now()->timestamp : $request['date_collected'][$eee],
            'smear_microscopy' => $request['smear_microscopy'][$eee],
            'tb_lamp' => $request['tb_lamp'][$eee],
            'culture' => $request['culture'][$eee],
            'form_id' => $form->id,
        ]);
    }
}
