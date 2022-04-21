<template>
    <div class="h-52 bg-cyan-700">
        <div class="mx-auto max-w-7xl px-4 py-2 sm:px-6 lg:px-8">
            <div class="mt-8">
                <div class="text-center text-white sm:text-center lg:text-left">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl" v-text="title"></h1>
                    <h2 class="mt-1 text-2xl font-medium" v-text="description"></h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    description: String,
});
</script>
