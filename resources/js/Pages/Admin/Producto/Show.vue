<script setup>
import AdminLayout from '@/Pages/Admin/Layouts/AdminLayout.vue';
import TablaProductos from '@/Pages/Admin/Producto/Partials/TablaProductos.vue';


const props = defineProps({
  productos: {
    type: Object,
    required: true,
  },
});

</script>

<template>
    <AdminLayout pageTitle="Administración Productos">
            <div class="bg-gradient-to-b from-white min-h-screen">
                <TablaProductos :productos="productos" />
            </div>
    </AdminLayout>
</template>

<style>

</style>
