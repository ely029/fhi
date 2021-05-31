<?php

declare(strict_types=1);

namespace App\Models;

use GuzzleHttp\Client;

class ITIS
{
    protected $url;

    protected $systemKey;

    protected $httpClient;

    protected $loginURL;

    public function __construct()
    {
        $this->url = config('services.itis.url');
        $this->systemKey = config('services.itis.key');
        $this->loginURL = config('services.itis.login_url');
        $this->httpClient = new Client();
    }

    public function getPatientForEnrollmentForm($data)
    {
        $url = $this->url.'/patient_data_tb_mac/'.$this->systemKey.'/patient_lastname/'.$data['last_name'].
        '/patient_firstname/'.$data['first_name'].'/patient_middlename/'.$data['middle_name'].'/patient_sex/'.$data['sex'].
        '/patient_birthday/'.$data['birthday'].'/patient_facility/'.$data['facility_code'];
        try {
            $result = $this->httpClient->get($url);
            return json_decode($result->getBody()->getContents());
        } catch (\Exception $exception) {
            \Log::warning('ITIS GET PATIENT ERROR: '.$exception->getMessage());
            return null;
        }
    }

    public function login($data)
    {
        $form = [
            'username' => $data['username'],
            'password' => $data['password'],
            'system_key' => config('services.itis.login_key'),
        ];
        try {
            $result = $this->httpClient->post($this->loginURL, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $form,
            ]);
            return json_decode($result->getBody()->getContents());
        } catch (\Exception $exception) {
            \Log::warning('ITIS LOGIN ERROR: '.$exception->getMessage());
            return null;
        }
    }
}
