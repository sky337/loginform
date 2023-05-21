<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $identifier = $request->input('identifier');

        if ($this->isValidMobileNumber($identifier)) {

            // Login with OTP
            $validator = Validator::make($request->all(), [
                'otp' => 'required|string|max:255',
                 'mobile' => 'required|max:10|min:10',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }
            $otp = $request->input('otp');
            // Validate OTP and perform login logic
        } elseif (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            // Login with password
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }
            $password = $request->input('password');

            if (!Hash::check($request->password, $user->password)){
                return response()->json(['message'=>"Credentials are wrong"],422);
            }

            
            // Validate password and perform login logic
        } else {
            // Invalid input, handle error
        }
    }

    // private function isValidMobileNumber($identifier)
    // {
    //     // Implement your validation logic for mobile number
    //     // Return true if valid, false otherwise
    //      // Remove any non-digit characters from the mobile number
    //      $cleanedNumber = preg_replace('/[^0-9]/', '', $number);

    //     // Validate the cleaned mobile number
    //     $pattern = '/^(\+|0)?[1-9][0-9]{9}$/';

    //      return preg_match($pattern, $cleanedNumber);
    // }
}
