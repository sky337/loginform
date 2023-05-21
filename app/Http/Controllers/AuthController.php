<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OTPCode;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'identifier' => 'required',
            'password' => 'required_without:otp',
            'otp' => 'required_without:password',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            // dd("in");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('identifier', 'password', 'otp');
        // dd($credentials);

        if ($this->isValidMobileNumber($credentials['identifier'])) {
            return $this->loginWithOTP($credentials['identifier'], $credentials['otp']);
        } elseif ($this->isValidEmail($credentials['identifier'])) {
            return $this->loginWithPassword($credentials['identifier'], $credentials['password']);
        }

        return redirect()->back()->withErrors(['message' => 'Invalid Input Details'])->withInput();
    }

    private function loginWithOTP($identifier, $otp)
    {
        $user = User::where('mobile', $identifier)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not found'])->withInput();
        }
        // Generate the OTP
        // $otpLength = 6;
        // $generatedOTP = '';
        // for ($i = 0; $i < $otpLength; $i++) {
        //     $generatedOTP .= mt_rand(0, 9); // Generate a random digit between 0 and 9
        // }

        // DB::table('otp_codes')->insert([
        //     'user_id' => $user->id,
        //     'otp' => $generatedOTP,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $otpCode = DB::table('o_t_p_codes')->where('user_id', $user->id)->latest()->first();

        if (!$otpCode || $otp !== $otpCode->otp) {
            return redirect()->back()->withErrors(['message' => 'Invalid OTP'])->withInput();
        }

        // OTP validation passed, perform the login process
        Auth::login($user);

        // Delete the OTP code from the database
        DB::table('o_t_p_codes')->where('id', $otpCode->id)->delete();

        return redirect()->intended('/dashboard');
    }

    private function loginWithPassword($identifier, $password)
    {
        if (Auth::attempt(['email' => $identifier, 'password' => $password])) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        return redirect()->back()->withErrors(['message' => 'Invalid email or password'])->withInput();
    }

    private function isValidMobileNumber($identifier)
    {
        // Implement your validation logic for mobile number
        // Return true if valid, false otherwise
        $pattern = '/^[0-9]{10}$/'; // Assuming the mobile number should be 10 digits long

        return preg_match($pattern, $identifier);
    }

    private function isValidEmail($identifier)
    {
        // Implement your validation logic for email
        // Return true if valid, false otherwise

        $validator = Validator::make(['email' => $identifier], [
            'email' => 'required|email',
        ]);

        return !$validator->fails();
    }

    public function dashboard()
    {
        return view('dashboard');
    }


    public function generateOTP(Request $request)
    {
        $identifier = $request->input('identifier');
        // dd("in");
        $user = User::where('mobile', $identifier)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otpLength = 6;
        $generatedOTP = '';
        for ($i = 0; $i < $otpLength; $i++) {
            $generatedOTP .= mt_rand(0, 9); // Generate a random digit between 0 and 9
        }

        try {
            $otpCode = OTPCode::create([
                'user_id' => $user->id,
                'otp' => $generatedOTP,
            ]);

            return response()->json([
                'otp' => $generatedOTP,
                'message' => 'OTP sent successfully!',
            ], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Failed to generate OTP'], 500);
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
        ]);

        // You can perform additional actions like sending a confirmation email, etc.

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }



    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'identifier' => 'required',
    //         'password' => 'required_if:login_type,password',
    //         'otp' => 'required_if:login_type,otp',
    //     ]);
    //         dd($validator);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $credentials = $request->only('identifier', 'password', 'otp', 'login_type');

    //     if ($credentials['login_type'] === 'password') {
    //         return $this->loginWithEmail($credentials);
    //     } elseif ($credentials['login_type'] === 'otp') {
    //         return $this->loginWithOTP($credentials['identifier'], $credentials['otp']);
    //     }

    //     return redirect()->back()->withErrors(['message' => 'Invalid login type']);
    // }

    // private function loginWithEmail($credentials)
    // {
    //     if (Auth::attempt(['email' => $credentials['identifier'], 'password' => $credentials['password']])) {
    //         // Authentication passed
    //         return redirect()->intended('/dashboard');
    //     }

    //     // Authentication failed
    //     return redirect()->back()->withErrors(['message' => 'Invalid email or password'])->withInput();
    // }

    // private function loginWithOTP($identifier, $otp)
    // {
    //     // Validate the OTP and perform login logic
    //     // Redirect to the appropriate page
    // }

}
