<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     *
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'], // Add validation for the surname field
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'day' => ['nullable', 'numeric'], // Make these fields nullable
            'month' => ['nullable', 'numeric'],
            'year' => ['nullable', 'numeric'],
            'gender' => ['nullable', 'in:male,female'], // Make gender field nullable
            // 'is_private' => ['required', 'in:0,1'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'surname' => $input['surname'], // Include the surname field
                'username' => $input['username'],
                'email' => $input['email'],
                // 'is_private' => $input['is_private'],
                'date_of_birth' => isset($input['year']) && isset($input['month']) && isset($input['day'])
                    ? $input['year'] . '-' . $input['month'] . '-' . $input['day']
                    : $user->date_of_birth, // Keep the existing date_of_birth if not provided
                'gender' => $input['gender'] ?? $user->gender, // Keep the existing gender if not provided
            ])->save();
            
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     *
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'surname' => $input['surname'], // Include the surname field
            'username' => $input['username'],
            'email' => $input['email'],
            // 'is_private' => true,
            'email_verified_at' => null,
            'date_of_birth' => isset($input['year']) && isset($input['month']) && isset($input['day'])
                ? $input['year'] . '-' . $input['month'] . '-' . $input['day']
                : $user->date_of_birth, // Keep the existing date_of_birth if not provided
            'gender' => $input['gender'] ?? $user->gender, // Keep the existing gender if not provided
        ])->save();
        
        $user->sendEmailVerificationNotification();
        

        $user->sendEmailVerificationNotification();
    }
}
