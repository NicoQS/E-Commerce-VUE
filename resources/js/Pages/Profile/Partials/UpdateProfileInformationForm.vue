<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';



const props = defineProps({
    user: Object,
    direccionUsuario: Object,
});



const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    photo: null,
    celular: props.user.celular,
    //Modelo Direccion
    numero: props.direccionUsuario[0].numero ? props.direccionUsuario[0].numero.toString() : '',
    direccion_1: props.direccionUsuario[0].direccion_1,
    direccion_2: props.direccionUsuario[0].direccion_2,
    provincia: props.direccionUsuario[0].provincia,
    localidad: props.direccionUsuario[0].localidad,
    codigo_postal: props.direccionUsuario[0].codigo_postal,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Información de Perfil
        </template>

        <template #description>
            Actualice la información de perfil, la dirección de correo electrónico de su cuenta y otros datos.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    id="photo"
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Foto" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 me-2" type="button" @click.prevent="selectNewPhoto">
                    Seleccionar una Nueva Foto
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Eliminar Foto
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Nombre" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            @click.prevent="sendEmailVerification"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </div>
                </div>
            </div>

            <!-- Celular -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="celular" value="Celular" />
                <TextInput
                    id="celular"
                    v-model="form.celular"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="celular"
                    minlength="10"
                    maxlength="10"
                />
                <InputError :message="form.errors.celular" class="mt-2" />
            </div>

            <!-- Numero (localidad) -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="numero" value="Numero (localidad)" />
                <TextInput
                    id="numero"
                    v-model="form.numero"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="form.errors.numero" class="mt-2" />
            </div>

            <!-- Direccion1 -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="direccion_1" value="Direccion 1" />
                <TextInput
                    id="direccion_1"
                    v-model="form.direccion_1"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="form.errors.direccion1" class="mt-2" />
            </div>

            <!-- Direccion2 -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="direccion_2" value="Direccion 2" />
                <TextInput
                    id="direccion_2"
                    v-model="form.direccion_2"
                    type="text"
                    class="mt-1 block w-full"
                />
                <InputError :message="form.errors.direccion_2" class="mt-2" />
            </div>

            <!-- Provincia -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="provincia" value="Provincia" />
                <TextInput
                    id="provincia"
                    v-model="form.provincia"
                    type="text"
                    class="mt-1 block w-full cursor-not-allowed"
                    required
                    disabled
                />
                <InputError :message="form.errors.provincia" class="mt-2" />
            </div>


            <!-- Localidad -->
            <div class="col-span-6 sm:col-span-4">
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

            <!-- Codigo Postal -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="codigo_postal" value="Codigo Postal" />
                <TextInput
                    id="codigo_postal"
                    v-model="form.codigo_postal"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="codigo_postal"
                />
                <InputError :message="form.errors.codigo_postal" class="mt-2" />
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Guardado.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Guardar
            </PrimaryButton>
        </template>
    </FormSection>
</template>
