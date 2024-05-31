<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    email: '',
    numero: '',
    direccion1: '',
    direccion2: '',
    provincia: 'San Juan',
    localidad: '',
    codigo_postal: '',
    celular: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <AppLayout title="Registro">

        <AuthenticationCard>

            <form @submit.prevent="submit">
                <div  class='mt-2'>
                    <InputLabel for="name" value="Nombre" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-2 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-2 block w-full"
                        required
                        autocomplete="email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Contraseña -->
                <div class="mt-2">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-2 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-2">
                    <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-2 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="celular" value="Celular" />
                    <TextInput
                        id="celular"
                        v-model="form.celular"
                        type="tel"
                        class="mt-2 block w-full"
                        required
                        autofocus
                        minlength="10"
                        maxlength="10"
                    />
                    <InputError class="mt-2" :message="form.errors.celular" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="numero" value="Numero (localidad)" />
                    <TextInput
                        id="numero"
                        v-model="form.numero"
                        type="text"
                        class="mt-2 block w-full"
                        required
                        autofocus
                        inputmode="numeric"
                    />
                    <InputError class="mt-2" :message="form.errors.numero" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="direccion1" value="Direccion 1" />
                    <TextInput
                        id="direccion1"
                        v-model="form.direccion1"
                        type="text"
                        class="mt-2 block w-full"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.direccion1" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="direccion2" value="Direccion 2" />
                    <TextInput
                        id="direccion2"
                        v-model="form.direccion2"
                        type="text"
                        class="mt-2 block w-full"
                        autofocus
                    />
                </div>

                <div class='mt-2'>
                    <InputLabel for="provincia" value="Provincia" />
                    <TextInput
                        id="provincia"
                        v-model="form.provincia"
                        type="text"
                        class="mt-2 block w-full cursor-not-allowed"
                        required
                        disabled
                    />
                    <InputError class="mt-2" :message="form.errors.provincia" />
                </div>

                <div class='mt-2'>
                    <InputLabel for="codigo_postal" value="Codigo Postal" />
                    <TextInput
                        id="codigo_postal"
                        v-model="form.codigo_postal"
                        type="text"
                        class="mt-2 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.codigo_postal" />
                </div>

                <!-- Localidad -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                    <InputLabel for="localidad" value="Localidad" />
                    <select id="localidad"
                        v-model="form.localidad"
                        class="block mt-2 w-full border-gray-300 rounded-md shadow-sm"
                        required
                        autofocus
                    >
                        <option value="No disponible">No disponible</option>
                        <option value="Chimbas">Chimbas</option>
                        <option value="Rivadavia">Rivadavia</option>
                        <option value="Santa Lucía">Santa Lucía</option>
                        <option value="Capital">Capital</option>
                        <option value="Rawson">Rawson</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.localidad" />
                </div>


                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-2">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                            <div class="ms-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-end mt-2">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ¿Ya estas registrado?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Registrarse
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>

    </AppLayout>

</template>
