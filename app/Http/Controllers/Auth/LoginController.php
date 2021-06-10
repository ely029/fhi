<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Geolocation;
use App\Models\ITIS;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginFormTest()
    {
        return view('auth.login-test');
    }

    public function itisLogin()
    {
        $itis = new ITIS();

        $data = [];
        $data['username'] = request('username');
        $data['password'] = request('password');

        $response = $itis->login($data);

        if ($response === 'Not Authorized' || is_null($response)) {
            return response()->json([
                'data' => $response,
            ]);
        }

        $itisUser = $response->USER_INFO[0];

        // get user from db with user id from itis
        $user = User::where('itis_id', $itisUser->USER_ID)
            ->where('username', $itisUser->USER_USERNAME)->first();

        $gLocations = $this->getGlocations($itisUser->USER_DEFAULT_STATION_LOCATON);

        if (is_null($user)) {
            $user = User::create([
                'name' => $itisUser->USER_NAME,
                'email' => $itisUser->USER_EMAIL,
                'password' => bcrypt($itisUser->USER_ID),
                'username' => $itisUser->USER_USERNAME,
                'itis_id' => $itisUser->USER_ID,
                'itis_access_area' => $itisUser->USER_ACCESS_AREA,
                'region_code' => $itisUser->USER_DEFAULT_STATION_LOCATON,
                'region' => $gLocations['region'],
                'province' => $gLocations['province'],
                'municipality' => $gLocations['municipality'],
                'role_id' => 3,
                'has_chosen_role' => false,
                'facility_name' => $itisUser->USER_DEFAULT_STATION_NAME,
                'facility_code' => $itisUser->USER_DEFAULT_STATION_ID,
            ]);
        } else {
            $user->update([
                'name' => $itisUser->USER_NAME,
                'email' => $itisUser->USER_EMAIL,
                'itis_access_area' => $itisUser->USER_ACCESS_AREA,
                'region_code' => $itisUser->USER_DEFAULT_STATION_LOCATON,
                'region' => $gLocations['region'],
                'province' => $gLocations['province'],
                'municipality' => $gLocations['municipality'],
                'has_chosen_role' => false,
                'facility_name' => $itisUser->USER_DEFAULT_STATION_NAME,
                'facility_code' => $itisUser->USER_DEFAULT_STATION_ID,
            ]);
        }

        Auth::login($user);
        return response()->json('Success');
    }

    public function getGlocations($code)
    {
        $geoLocation = Geolocation::where('id', $code)->first();

        if (is_null($geoLocation)) {
            return [
                'region' => null,
                'province' => null,
                'municipality' => null,
            ];
        }

        // query the province
        $province = Geolocation::where('id', $geoLocation->PARENT_ID)->first();
        // get region of province
        $region = Geolocation::where('id', $province->PARENT_ID)->first();
        return [
            'region' => $region->name1,
            'province' => $province->name1,
            'municipality' => $geoLocation->name1,
        ];
    }
}
