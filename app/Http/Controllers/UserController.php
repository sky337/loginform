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
            $otp = $request->input('otp');
            // Validate OTP and perform login logic
        } elseif (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            // Login with password
            $password = $request->input('password');
            // Validate password and perform login logic
        } else {
            // Invalid input, handle error
        }
    }

    private function isValidMobileNumber($identifier)
    {
        // Implement your validation logic for mobile number
        // Return true if valid, false otherwise
         // Remove any non-digit characters from the mobile number
         $cleanedNumber = preg_replace('/[^0-9]/', '', $number);

        // Validate the cleaned mobile number
        $pattern = '/^(\+|0)?[1-9][0-9]{9}$/';

         return preg_match($pattern, $cleanedNumber);
    }
}
