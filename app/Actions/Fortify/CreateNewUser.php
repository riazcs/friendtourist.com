<?php

namespace App\Actions\Fortify;

use App\Jobs\SendOTPSMSJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $otp = mt_rand(11111, 99999);
        $text = "Your OTP from ". config('app.name') . ": " . $otp . ". Don't share it with others";
        $mask = "NOMASK";
        $phone = $input['phone'];
        dispatch(new SendOTPSMSJob($mask , $phone, $text));

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'otp'=> $otp,
            'can_verified_after' => Carbon::now()->addMinutes(5),
            'user_type' => User::Roles['User'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
