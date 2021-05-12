<?php

declare(strict_types=1);

use App\Exceptions\HttpApiException;

// @TB: Override existing or add new helper functions
// Overriding requires funkjedi/composer-include-files
// https://laravel-news.com/creating-helpers

// See .htaccess: Filename-based cache busting.
function asset($path, $secure = null)
{
    if (! App::isLocal()) {
        $publicPath = public_path($path);

        if (file_exists($publicPath)) {
            $pattern = '@\.(bmp|css|cur|gif|ico|jpe?g|m?js|png|svgz?|webp|webmanifest)$@i';
            $replacement = '.' . filemtime($publicPath) . '.$1';

            $path = preg_replace($pattern, $replacement, $path);
        }
    }

    return app('url')->asset($path, $secure);
}

function abort($code, $message = '', $docUrl = '', array $headers = [])
{
    throw new HttpApiException($message, $docUrl, null, $code, $headers);
}

function provinces()
{
    return [
        'Metro Manila',
        'Abra',
        'Agusan del Norte',
        'Agusan del Sur',
        'Aklan',
        'Albay',
        'Antique',
        'Apayao',
        'Aurora',
        'Basilan',
        'Bataan',
        'Batanes',
        'Batangas',
        'Biliran',
        'Benguet',
        'Bohol',
        'Bukidnon',
        'Bulacan',
        'Cagayan',
        'Camarines Norte',
        'Camarines Sur',
        'Camiguin',
        'Capiz',
        'Catanduanes',
        'Cavite',
        'Cebu',
        'Compostela',
        'Davao del Norte',
        'Davao del Sur',
        'Davao Oriental',
        'Eastern Samar',
        'Guimaras',
        'Ifugao',
        'Ilocos Norte',
        'Ilocos Sur',
        'Iloilo',
        'Isabela',
        'Kalinga',
        'Laguna',
        'Lanao del Norte',
        'Lanao del Sur',
        'La Union',
        'Leyte',
        'Maguindanao',
        'Marinduque',
        'Masbate',
        'Mindoro Occidental',
        'Mindoro Oriental',
        'Misamis Occidental',
        'Misamis Oriental',
        'Mountain Province',
        'Negros Occidental',
        'Negros Oriental',
        'North Cotabato',
        'Northern Samar',
        'Nueva Ecija',
        'Nueva Vizcaya',
        'Palawan',
        'Pampanga',
        'Pangasinan',
        'Quezon',
        'Quirino',
        'Rizal',
        'Romblon',
        'Samar',
        'Sarangani',
        'Siquijor',
        'Sorsogon',
        'South Cotabato',
        'Southern Leyte',
        'Sultan Kudarat',
        'Sulu',
        'Surigao del Norte',
        'Surigao del Sur',
        'Tarlac',
        'Tawi-Tawi',
        'Zambales',
        'Zamboanga del Norte',
        'Zamboanga del Sur',
        'Zamboanga Sibugay',
    ];
}

function month_treatment()
{
    return [
        '0',
        '1st',
        '2nd',
        '3rd',
        '4th',
        '5th',
        '6th',
        '7th',
        '8th',
        '9th',
        '10th',
        '11th',
        '12th',
        '13th',
        '14th',
        '15th',
        '16th',
        '17th',
        '18th',
        '19th',
        '20th',
    ];
}

function current_drug_susceptibility()
{
    return [
        'Drug-susceptible',
        'Bacteriologically-confirmed RR-TB',
        'Bacteriologically-confirmed MDR-TB',
        'Bacteriologically-confirmed Pre-XDR-TB',
        'Bacteriologically-confirmed XDR-TB',
        'Clinically-confirmed MDR-TB',
        'Other Drug-resistant TB',
    ];
}

function resistance_pattern()
{
    return [
        'For Xpert MTB/RIF',
        'For Xpert MTB/RIF ULTRA',
        'Truenat',
    ];
}

function method_used()
{
    return [
        'MTB Detected, Rifampicin Resistance Detected',
        'MTB Detected, Rifampicin Resistance Not Detected',
        'MTB Detected, Rifampicin Resistance Indeterminate',
        'MTB Not Detected',
        'Indeterminate',
        'MTB Detected Trace, Rifampicin Resistance',
        'Invalid/No Result/Error',
    ];
}

function smear_microscopy()
{
    return [
        '0',
        '+n',
        '1+',
        '2+',
        '3+',
    ];
}

function tb_lamp()
{
    return [
        'Positive',
        'Negative',
        'Indeterminate',
    ];
}

function culture()
{
    return [
        'Positive',
        'Negative',
        'Non-tuberculous Mycobacteria (NTM)',
        'Contaminated',
    ];
}

function treatmentCulture()
{
    return [
        'Positive',
        'Negative',
        'Non-tuberculous Mycobacteria (NTM)',
        'Contaminated',
        'Not done',
    ];
}

function treatmentCxrReading()
{
    return [
        'Improved',
        'Stable/Unchanged',
        'Worsened',
    ];
}

function treatmentOutome()
{
    return [
        'Cured',
        'Treatment Completed',
        'Failed',
        'Lost to Follow-up',
        'Died',
        'Excluded',
    ];
}

function suggested_regimen()
{
    return [
        'Regimen 3 SSOR',
        'Regimen 4 SLOR FQ-S',
        'Regimen 5 SLOR FQ-R',
        'Regimen 6a SLOR FQ-S',
        'Regimen 6b SLOR FQ-S',
        'Regimen 6c SLOR FQ-S',
        'Regimen 7a SLOR FQ-R',
        'Regimen 7b SLOR FQ-R',
        'Regimen 7c SLOR FQ-R',
        'ITR',
        'BPaL',
        'Other (Specify)',
    ];
}

function updated_type_of_case()
{
    return [
        'Drug-susceptibility',
        'Bacteriologically-confirmed RR-TB',
        'Bacteriologically-confirmed MDR-TB',
        'Bacteriologically-confirmed Pre-XDR-TB',
        'Bacteriologically-confirmed XDR-TB',
        'Clinically-confirmed MDR-TB',
        'Other Drug-resistant TB',
    ];
}

function latest_comparative_cxr_reading()
{
    return [
        'Improved',
        'Stable/Unchanged',
        'Worsened',
    ];
}

function DST()
{
    return [
        'H-Susceptible',
        'H-Resistance',
        'H-Not Done',
        'R-Susceptible',
        'R-Resistance',
        'E-Susceptible',
        'E-Resistant',
        'E-Not Done',
        'Z-Susceptible',
        'Z-Resistant',
        'Z-Not done',
        'Mfx-Susceptible',
        'Mfx-Resistant',
        'Mfx-Not done',
        'Lfx-Susceptible',
        'Lfx-Resistant',
        'Lfx-Not done',
        'S-Susceptible',
        'S-Resistant',
        'S-Not Done',
        'Am-Susceptible',
        'Am-Resistant',
        'Am-Not Done',
        'Other (specify)',
    ];
}

function LPA()
{
    return [
        'MTB Detected, Fluoroquinolone Resistance Detected',
        'MTB Detected, Fluoroquinolone Resistance Not Detected',
        'MTB Detected, Fluoroquinolone Resistance Indeterminate',
        'MTB Detected, Second-line Injectable Resistance Detected',
        'MTB Detected, Second-line Injectable Resistance Not Detected',
        'MTB Detected, Second-line Injectable Resistance Indeterminate',
        'MTB Detected, High Dose Isoniazid Resistance Detected',
        'MTB Detected, High Dose Isoniazid Resistance Not Detected',
        'MTB Detected, High Dose Isoniazid Resistance Indeterminate',
        'MTB Detected, Low Dose Isoniazid Resistance Detected',
        'MTB Detected, Low Dose Isoniazid Resistance Not Detected',
        'MTB Detected, Low Dose Isoniazid Resistance Indeterminate',
        'MTB Not Detected',
        'Invalid',
    ];
}

function roleNameById()
{
    return [
        3 => 'HealthCareWorker',
        4 => 'RegionalSecretariat',
    ];
}

function enrollmentFormTabs()
{
    return [
        'with_recommendations' => ['For Enrollment','Not for Referral','Not For Enrollment','Need Further Details','Referred to regional chair'],
        'completed' => ['For Enrollment','Not For Enrollment','Need Further Details'],
        'all_enrollments' => ['New Enrollment','Referred to Regional'],
        'all_enrollments_ntb_chair' => ['For Enrollment','Not For Enrollment','Need Further Details','Referred to regional chair'],
        'all_enrollments_ntb' => ['For Enrollment','Not For Enrollment','Need Further Details','Referred to regional chair'],
    ];
}

function caseManagementRecommendationStatus()
{
    return [
        4 => 'required|in:Referred to Regional,Not for Referral',
        5 => 'required|in:Recommend for Approval,Recommend for other suggestions,Recommend for need further details',
        6 => 'required|in:For approval,Other suggestions,Need Further Details,Referred to National',
        7 => 'required|in:Referred to National Chair',
        8 => 'nullable|in:Referred back to regional chair',
    ];
}

function caseManagementTabs()
{
    return [
        'with_recommendations' => ['For approval','Other suggestions','Need Further Details','Referred to National'],
        'completed' => ['For approval','Other suggestions','Need Further Details'],
        'all_cases_ntb' => ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair'],
        'all_cases_ntb_chair' => ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair'],
    ];
}

function treatmentOutcomeTabs()
{
    return [
        'all_cases' => ['New Case', 'Referred to Regional', 'Referred to Regional Chair', 'Referred to National', 'Referred to National Chair', 'For approval', 'Not for Approval', 'Referred back to Regional Chair'],
        'with_recommendations' => ['For approval','Other suggestions','Need Further Details','Referred to National'],
        'all_cases_ntb' => ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair'],
        'all_cases_ntb_chair' => ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair'],
        'completed' => ['For approval', 'Other suggestions', 'Need further Details', 'Referred to National Chair'],
    ];
}

function getDynamicQuery()
{
    return [
        3 => [
            'condition' => 'submitted_by',
            'value' => auth()->user()->id,
        ],
        4 => [
            'condition' => 'region',
            'value' => 'NCR',
        ],
        5 => [
            'condition' => 'region',
            'value' => 'NCR',
        ],
        6 => [
            'condition' => 'region',
            'value' => 'NCR',
        ],
        7 => [
            'condition' => 'form_type',
            'value' => 'treatment_outcome',
        ],
        8 => [
            'condition' => 'form_type',
            'value' => 'treatment_outcome',
        ],
    ];
}

function treatmentOutcomeIndex3($cases)
{
    $forApproval = $cases->filter(function ($item) {
        return $item->status === 'For approval';
    });
    $otherSuggestion = $cases->filter(function ($item) {
        return $item->status === 'Other suggestions';
    });
    $needFurtherDetails = $cases->filter(function ($item) {
        return $item->status === 'Need Further Details';
    });
    $notForReferral = $cases->filter(function ($item) {
        return $item->status === 'Not for Referral';
    });
    return view('case-management.index')
        ->with('forApproval', $forApproval)
        ->with('allCases', $cases)
        ->with('needFurtherDetails', $needFurtherDetails)
        ->with('otherSuggestion', $otherSuggestion)
        ->with('notForReferral', $notForReferral);
}
