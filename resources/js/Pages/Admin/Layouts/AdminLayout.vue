<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SideBar from '@/Pages/Admin/Components/Sidebar.vue';

defineProps({
	pageTitle: {
		type: String,
		required: false,
		default: 'Administración'
	}
});

const showingNavigationDropdown = ref(false);

</script>


<template>

    <AppLayout title="Admin">
        <template #header>
            <div class="flex items-center">
                <div class="grow">
                    <h2 class="font-semibold text-xl text-gray-800">
                        {{ $props.pageTitle }}
                    </h2>
                </div>
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

        </template>
		<div>
			<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
            <div class="min-h-screen flex flex-row bg-gray-100">

                <!-- Sidebar -->
                <SideBar :class="{'block sm:block': showingNavigationDropdown, 'hidden sm:block': ! showingNavigationDropdown}" />

				<!-- Content -->
				<main class="grow">
					<slot />
				</main>
            </div>
        </div>
    </AppLayout>

</template>
