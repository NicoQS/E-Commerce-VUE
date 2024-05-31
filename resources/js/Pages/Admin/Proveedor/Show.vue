<script setup>
import AdminLayout from '@/Pages/Admin/Layouts/AdminLayout.vue';
import TablaProveedores from '@/Pages/Admin/Proveedor/Partials/TablaProveedores.vue';


const props = defineProps({
  proveedores: {
    type: Object,
    required: true,
  },
});

</script>

<template>
    <AdminLayout pageTitle="Administración Proveedores">
            <div class="bg-gradient-to-b from-white min-h-screen">
                <TablaProveedores :proveedores="proveedores" />
            </div>
    </AdminLayout>
</template>

<style>

</style>
