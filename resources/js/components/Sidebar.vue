<template>
    <div
        class="flex flex-grow flex-col overflow-y-auto rounded-md bg-cyan-700 pt-5 pb-4"
    >
        <nav
            class="mt-5 flex flex-1 flex-col divide-y divide-cyan-800 overflow-y-auto"
            aria-label="Sidebar"
        >
            <div class="space-y-1 px-2">
                <Link
                    href="/"
                    class="group flex items-center rounded-md bg-cyan-800 px-2 py-2 text-sm font-medium leading-6 text-white"
                    aria-current="page"
                >
                    <svg
                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                    Home
                </Link>

                <Link
                    href="/events"
                    class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-white hover:bg-cyan-600 hover:text-white"
                >
                    <svg
                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                        />
                    </svg>
                    Seminors
                </Link>
            </div>

            <div class="mt-3 pt-6">
                <p
                    class="px-6 text-xs font-semibold uppercase tracking-wider text-cyan-200"
                    id="communities-headline"
                >
                    Counties
                </p>

                <div class="space-y-1 px-4 pt-2">
                    <Link
                        href="?city=all"
                        class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-white hover:bg-cyan-600 hover:text-white"
                    >
                        All
                    </Link>
                    <Link
                        :href="'?city=' + county.name"
                        v-for="county in counties"
                        :key="county.id"
                        class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-white hover:bg-cyan-600 hover:text-white"
                    >
                        {{ county.name }}
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps({ counties: Array });
</script>
