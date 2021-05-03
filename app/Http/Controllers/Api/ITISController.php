<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ITIS;

class ITISController extends Controller
{
    public function getPatient()
    {
        $itis = new ITIS();
        $data = [];
        $data['last_name'] = request('last_name');
        $data['first_name'] = request('first_name');
        $data['middle_name'] = request('middle_name');
        $data['sex'] = request('sex');
        $data['birthday'] = request('birthday');
        $data['facility_code'] = request('facility_code');

        return response()->json([
            'data' => $itis->getPatientForEnrollmentForm($data),
        ]);
    }
}
