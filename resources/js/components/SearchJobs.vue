<template>
    <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
        <div
            class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0"
        >
            <div class="w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                    >
                        <!-- Heroicon name: solid/search -->
                        <svg
                            class="h-5 w-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <input
                        id="search"
                        class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:border-cyan-500 focus:text-gray-900 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-cyan-500 sm:text-sm"
                        placeholder="Search"
                        :value="modelValue"
                        @input="$emit('update:modelValue', $event.target.value)"
                        type="search"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    modelValue: String,
});

defineEmits(["update:modelvalue"]);
</script>
