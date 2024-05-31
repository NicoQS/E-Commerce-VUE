<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\DireccionUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Traits\HasRoles;

class CreateNewUser implements CreatesNewUsers
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'celular'=> ['required', 'string', 'max:10'],
            'numero' => ['required', 'string', 'max:10'],
            'direccion1' => ['required', 'string', 'max:255'],
            'provincia' => ['required', 'string', 'max:255'],
            'localidad' => ['required', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'celular' => $input['celular'],
            'password' => Hash::make($input['password']),
        ])->assignRole('user');

        DireccionUsuario::create([
            'user_id' => $user->id,
            'numero' => intval($input['numero']),
            'direccion_1' => $input['direccion1'],
            'direccion_2' => $input['direccion2'],
            'provincia' => $input['provincia'],
            'localidad' => $input['localidad'],
            'codigo_postal' => $input['codigo_postal'],
        ]);

        return $user;
    }
}
