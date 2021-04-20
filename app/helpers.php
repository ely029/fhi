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
