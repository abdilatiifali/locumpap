<template>
    <div class="bg-gray-100">
        <div class="mx-auto max-w-7xl py-16 px-4 sm:px-6 lg:px-8">
            <p
                class="text-center text-sm font-semibold uppercase tracking-wide text-gray-500"
            >
                Trusted by hospitals all over kenya.
            </p>
            <div
                class="mt-6 grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5"
            >
                <div
                    v-for="partner in partners"
                    :key="partner"
                    class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1"
                >
                    <img
                        class="h-12"
                        :src="partner"
                        alt="Tuple"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    partners: Array
})
</script>
