<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\DireccionUsuario;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'direccion_1' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'string', 'max:10'],
            'provincia' => ['required', 'string', 'max:255'],
            'localidad' => ['required', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:10'],
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
                'email' => $input['email'],
            ])->save();
        }

        // Actualizar la direccion del usuario
        $direccionData = [
            'numero' => $input['numero'],
            'direccion_1' => $input['direccion_1'],
            'direccion_2' => $input['direccion_2'],
            'celular' => $input['celular'],
            'localidad' => $input['localidad'],
            'codigo_postal' => $input['codigo_postal'],
        ];
        if (isset($input['direccion_2'])) {
            $direccionData['direccion_2'] = $input['direccion_2'];
        }

        $direccion = $user->direcciones()->first();
        if ($direccion) {
            $direccion->update($direccionData);
        } else {
            $user->direcciones()->create($direccionData);
        }

    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
