<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

final class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'company_id' => Rule::when((bool) $input['company_id'], [
                'required',
                'digits:8',
            ]),
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'email' => $input['email'],
            'company_id' => $input['company_id'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
