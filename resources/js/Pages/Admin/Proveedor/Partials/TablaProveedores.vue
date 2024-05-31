<script setup>
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerMessage from '@/Components/DangerMessage.vue';
import { ref, watch } from 'vue';


const props = defineProps({
  proveedores: {
    type: Object,
    required: true,
  },
});

let searchTerm = ref('');
let filteredProviders= ref([]);

const filterProducts = () => {
  if (searchTerm.value) {
    filteredProviders.value = props.proveedores.data.filter(proveedor =>
      proveedor.nombre.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
  } else {
    filteredProviders.value = props.proveedores.data;
  }

};

filterProducts();


watch(searchTerm, () => {
  filterProducts();
});

</script>

<template>
	<div class="flex flex-col">
		<div class="overflow-auto">
			<!-- Busqueda -->
            <div class="py-3 pl-2 flex md:place-content-center">
                <div class="relative max-w-xs">
                    <label for="hs-table-search" class="sr-only">
                        Search
                    </label>
                    <input
                        type="text"
                        name="search"
                        v-model="searchTerm"
                        class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500  dark:border-gray-700 dark:text-gray-700"
                        placeholder="Search..."
                    />
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </div>
                </div>
                <div class="py-1.5 pl-2">
                    <PrimaryButton>
                        Agregar proveedor
                    </PrimaryButton>
                </div>
            </div>

			<!-- Tabla -->
			<div class="mt-2">
				<div v-if="filteredProviders.length == 0">
					<DangerMessage type="Error" message="Los proveedores que busca no existen o debe cargalos primero."></DangerMessage>
				</div>
				<div v-else class="flex place-content-center">
					<div class="p-1.5 inline-block align-middle">
						<div class="border border-gray-400 rounded-lg">
							<table class="divide-y divide-gray-400 table-fixed">
								<thead class="bg-gray-50">
									<tr>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											ID
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Nombre
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Email
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Cuit
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Telefono
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Celular
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Direccion
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
											Edit
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
											Delete
										</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-gray-400">
									<tr v-for="proveedor in filteredProviders" class="hover:bg-neutral-200">
										<td class="px-6 py-4 text-sm font-medium text-gray-800">
											{{ proveedor.id }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.nombre }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.email }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.cuit }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.telefono }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.celular }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ proveedor.direccion }}
										</td>
										<td
											class="px-6 py-4 text-sm font-medium text-right">
											<a class="text-green-500 hover:text-green-700" href="#">
												Edit
											</a>
										</td>
										<td class="px-6 py-4 text-sm font-medium text-right">
											<a class="text-red-500 hover:text-red-700" href="#" >
												Delete
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="flex place-content-center py-4">
							<Pagination :links="proveedores.links" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

</script>
