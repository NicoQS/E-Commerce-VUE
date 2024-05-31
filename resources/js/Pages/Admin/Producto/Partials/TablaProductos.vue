<script setup>
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import DangerMessage from '@/Components/DangerMessage.vue';
import { ref, watch, onMounted } from 'vue';
import {Link} from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { useForm } from '@inertiajs/vue3';



const props = defineProps({
    productos: {
        type: Object,
        required: true,
    },
});

const openModal = ref(false);
let searchTerm = ref('');
let filteredProducts = ref([]);

const form = useForm({
	id: '',
});

const filterProducts = () => {
  if (searchTerm.value) {
    filteredProducts.value = props.productos.data.filter(producto =>
      producto.nombre.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
  } else {
    filteredProducts.value = props.productos.data;
  }
};

const cargaProductos = () => {
	openModal.value = true;
};

const closeModal = () => {
	openModal.value = false;
};


onMounted(() => {
  filterProducts();
});
watch(searchTerm, () => {
  filterProducts();
});

const showAlert = (id) => {
	form.id = id;
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!"
	}).then((result) => {
		if (result.isConfirmed) {
			form.delete(route('admin.productos.destroy', {id: form.id}), {
				onSuccess: () => {
					Swal.fire(
						"Deleted!",
						"Your file has been deleted.",
						"success"
					);
                    filterProducts();
				},
				onError: () => {
					Swal.fire(
						"Error!",
						"Your file has not been deleted.",
						"error"
					);
				},
                onFinish: () => form.reset(),
			});
		}
	});
}
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
                    <PrimaryButton @click="cargaProductos">
                        Agregar Productos
                    </PrimaryButton>
                    <DialogModal :show="openModal" @close="closeModal">
                        <template #title>
                            Carga de Productos
                        </template>

                        <template #content>
                            Tiene 3 opciones:
                            <br> 1) Cargar un archivo Excel con los productos de manera online.
                            <br> 2) Carga masiva mediente un archivo Excel (.xlsx).
                            <br> 3) Carga unitaria de productos.
                        </template>

                        <template #footer>
                            <div class="flex text-center">
                                <Link class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Google Sheet
                                </Link>
                                <Link class="mx-2 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Carga Masiva Manual
                                </Link>
                                <Link :href="route('admin.productos.create')" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Carga Unitaria
                                </Link>
                                <SecondaryButton @click="closeModal" class="ml-2">
                                    Cancelar
                                </SecondaryButton>
                            </div>
                        </template>
                    </DialogModal>
                </div>
            </div>

			<!-- Tabla -->
			<div>
				<div v-if="filteredProducts.length == 0">
                    <DangerMessage type="Error" message="Los productos que busca no existen o debe cargalos primero."></DangerMessage>
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
											Name
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Descripción
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Stock
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Precio
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Categoria
										</th>
										<th
											scope="col"
											class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
											Proveedor
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
									<tr v-for="producto in filteredProducts" class="hover:bg-neutral-200">
										<td class="px-6 py-4 text-sm font-medium text-gray-800">
											{{ producto.id }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.nombre }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.descripcion }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.stock }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.precio }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.categoria }}
										</td>
										<td class="px-6 py-4 text-sm text-gray-800">
											{{ producto.proveedor }}
										</td>
										<td
											class="px-6 py-4 text-sm font-medium text-right">
											<Link :href="route('admin.productos.edit', {id: producto.id})" class="text-green-500 hover:text-green-700" href="#">
												Edit
											</Link>
										</td>
										<td class="px-6 py-4 text-sm font-medium text-right">
                                            <a @click="showAlert(producto.id)" class="text-red-500 hover:text-red-700">
                                                Delete
                                            </a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="flex place-content-center py-4">
							<Pagination :links="productos.links" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

</script>
