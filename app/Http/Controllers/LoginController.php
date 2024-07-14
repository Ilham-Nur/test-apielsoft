<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi reCAPTCHA
        $recaptchaSecret = config('services.recaptcha.secret');
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        $recaptchaData = $recaptcha->json();

        if (!$recaptchaData['success']) {
            return back()->withErrors(['recaptcha' => 'reCAPTCHA validation failed.']);
        }
        $formData = [
            'UserName' => $request->UserName,
            'Password' => $request->Password,
            'Company' => 'd3170153-6b16-4397-bf89-96533ee149ee',
            'browserInfo' => [
                'chrome' => true,
                'chrome_view' => false,
                'chrome_mobile' => false,
                'chrome_mobile_ios' => false,
                'safari' => false,
                'safari_mobile' => false,
                'msedge' => false,
                'msie_mobile' => false,
                'msie' => false
            ],
            'machineInfo' => [
                'brand' => 'Apple',
                'model' => '',
                'os_name' => 'Mac',
                'os_version' => '10.15',
                'type' => 'desktop'
            ],
            'osInfo' => [
                'android' => false,
                'blackberry' => false,
                'ios' => false,
                'windows' => false,
                'windows_phone' => false,
                'mac' => true,
                'linux' => false,
                'chrome' => false,
                'firefox' => false,
                'gamingConsole' => false
            ],
            'osNameInfo' => [
                'name' => 'Mac',
                'version' => '10.15',
                'platform' => ''
            ],
            'Device' => 'web_1703742830368',
            'Model' => 'Admin Web',
            'Source' => '103.242.150.163',
            'Exp' => 3
        ];

        $response = Http::post('https://core.api.elsoft.id/portal/api/auth/signin', $formData);

        if ($response->successful()) {
            $data = $response->json();
            Session::put('access_token', $data['access_token']);
            Session::put('refresh_token', $data['refresh_token']);
            Session::put('loggedInUser', $request->UserName);
            return response()->json(['redirect_url' => '/dashboardnew']);
        } else {
            return back()->withErrors(['message' => 'Login failed.'], );
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}

