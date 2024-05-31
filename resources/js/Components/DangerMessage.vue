<script setup>

defineProps({
  message: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    required: false,
    default: 'info',
  },
});

</script>

<template>

    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">{{ type }}</p>
        <p>{{ message }}</p>
    </div>

</template>
