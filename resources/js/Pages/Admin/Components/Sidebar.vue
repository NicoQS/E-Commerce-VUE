<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
	<div class="flex flex-col bg-gradient-to-b from-white pr-14 shrink-0">
		<ul class="flex flex-col py-2">
			<li>
				<NavLink :href="route('admin.productos.index')" :active="route().current('admin.productos.*')" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
				<span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
				<span class="text-sm font-medium">Productos</span>
                </NavLink>
			</li>
			<li>
				<NavLink :href="route('admin.proveedores.index')" :active="route().current('admin.proveedores.*')" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
				<span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-music"></i></span>
				<span class="text-sm font-medium">Proveedores</span>
				</NavLink>
			</li>
			<li>
				<a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
				<span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-drink"></i></span>
				<span class="text-sm font-medium">Categorias</span>
				</a>
			</li>
			<li>
				<a ref="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
				<span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-shopping-bag"></i></span>
				<span class="text-sm font-medium">Usuarios</span>
                </a>
			</li>
            <li>
				<a ref="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
				<span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-shopping-bag"></i></span>
				<span class="text-sm font-medium">Pedidos</span>
                </a>
			</li>
		</ul>
	</div>
</template>
