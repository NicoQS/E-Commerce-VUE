<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Swal from 'sweetalert2';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';



const props = defineProps({
    producto: {
        type: Object,
        required: true,
    },
    categorias: {
        type: Array,
        required: true,
    },
    imagenes: {
        type: Array,
        required: true,
    },
    proveedores: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    _method: 'PUT',
    nombre: props.producto.nombre,
    descripcion: props.producto.descripcion,
    precio: props.producto.precio,
    stock: props.producto.stock ? props.producto.stock.toString() : '',
    categoria_id: props.producto.categoria_id,
    proveedor_id: props.producto.proveedor_id,
});

const actualizarProducto = () => {
    /* console.log(form.categoria, form.proveedor); */
    form.post(route('admin.productos.update', props.producto.id), {
        errorBag: 'actualizarProducto',
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire(
                '¡Actualizado!',
                'El producto ha sido actualizado.',
                'success'
            );
            form.reset();
        },
        onError: (errors) => {
            /* console.log(errors); */
            Swal.fire(
                '¡Error!',
                'El producto no ha sido actualizado.',
                'error'
            );
        },
    })
};

</script>


<template>

    <Head title="Editar Producto" />

    <div class="bg-gradient-to-b from-gray-200 to-white">
        <FormSection class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" @submitted="actualizarProducto">
            <template #title>
                <h2 class="font-semibold text-xl text-gray-600">Editar Producto</h2>
            </template>

            <template #description>
                <p class="text-gray-500 mb-6">Puede modificar los campos del producto que usted desee.</p>
            </template>

            <template #form >
                <div class="md:col-span-5">
                    <InputLabel for="name" value="Nombre" />
                    <TextInput
                        id="nombre"
                        v-model="form.nombre"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.nombre" class="mt-2" />
                </div>

                <div class="md:col-span-5">
                    <InputLabel for="descripcion" value="Descripción" />
                    <TextInput
                        id="descripcion"
                        v-model="form.descripcion"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.descripcion" class="mt-2" />
                </div>

                <div class="md:col-span-5">
                    <InputLabel for="precio" value="Precio" />
                    <TextInput
                        id="precio"
                        v-model="form.precio"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.precio" class="mt-2" />
                </div>

                <div class="md:col-span-5">
                    <InputLabel for="stock" value="Stock" />
                    <TextInput
                        id="stock"
                        v-model="form.stock"
                        type="number"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.stock" class="mt-2" />
                </div>
                <div class="md:col-span-5">
                    <InputLabel for="categoria" value="Categoria" />
                    <select id="categoria" v-model="form.categoria_id" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option v-for="categoria in categorias" :value="categoria.id" :key="categoria.id">
                            {{ categoria.nombre }}
                            <option v-for="subcategoria in categoria.subcategorias" :value="subcategoria.id" :key="subcategoria.id">
                                - {{ subcategoria.nombre }}
                            </option>
                        </option>
                    </select>
                    <InputError :message="form.errors.categoria" class="mt-2" />
                </div>

                <div class="md:col-span-5">
                    <InputLabel for="proveedor" value="Proveedor" />
                    <select id="proveedor" v-model="form.proveedor_id" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option v-for="proveedor in proveedores" :value="proveedor.id" :key="proveedor.id">
                            {{ proveedor.nombre }}
                        </option>
                    </select>
                    <InputError :message="form.errors.proveedor" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <div class="md:col-span-5 text-right">
                    <ActionMessage :on="form.recentlySuccessful" class="me-3">
                        Guardado.
                    </ActionMessage>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Guardar
                    </PrimaryButton>
                </div>
            </template>
        </FormSection>
    </div>

</template>
