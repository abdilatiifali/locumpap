<template>
    <button
        :disabled="loading"
        :class="{ 'opacity-50': disable }"
        class="inline-flex justify-center rounded-md border border-transparent bg-cyan-500 py-3 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-700 focus:ring-offset-2"
    >
        <div v-if="loading" class="btn-spinner mr-2" />
        <slot />
    </button>
</template>

<script setup>
defineProps({
    loading: Boolean,
    disable: Boolean,
});
</script>
