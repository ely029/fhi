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
        'all_enrollments_ntb_chair' => ['Referred to national','For Enrollment','Not For Enrollment','Need Further Details'],
    ];
}
