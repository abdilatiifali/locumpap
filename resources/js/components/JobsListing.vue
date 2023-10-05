<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="overflow-hidden sm:rounded-md md:bg-white md:shadow">
        <ul
            role="list"
            class="space-y-4 md:space-y-0 md:divide-y md:divide-gray-200"
        >
            <li
                v-for="job in jobs.data"
                :key="job.id"
                class="rounded-md bg-white md:rounded-none md:bg-transparent md:hover:rounded-md"
            >
                <Link
                    :href="`/jobs/${job.slug}`"
                    class="block hover:bg-gray-50"
                >
                    <div class="px-4 py-4 sm:px-6">
                        <div class="md:flex items-center justify-between">
                            <div>
                                <p
                                    style="text-wrap: wrap;"
                                    class="text-sm font-medium text-cyan-600"
                                    v-text="job.title"
                                >
                                    
                                </p>
                            </div>

                            <div class="mt-2 md:mt-0 md:ml-auto">

                                <div class="flex">
                                    <div class="inline-flex items-center rounded-full px-2 bg-yellow-100 text-xs font-semibold leading-5 text-yellow-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="flex h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <p class="inline-flex rounded-full px-2 bg-yellow-100 text-xs font-semibold leading-5 text-yellow-800">
                                            {{ job.deadline  }}
                                        </p>
                                    </div>

                                    <div class="ml-2 flex flex-shrink-0">
                                        <p
                                            :class="{'bg-cyan-100 text-cyan-800': job.type == 'Locum'}"
                                            class="inline-flex rounded-full px-2 bg-red-100 text-xs font-semibold leading-5 text-red-800"
                                            v-text="job.type"
                                        ></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p
                                    class="flex items-center text-sm text-gray-500"
                                >
                                    <!-- Heroicon name: solid/users -->
                                   <UserIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                    {{ job.profession.name }}
                                </p>
                                <p
                                    class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6"
                                >
                                    <!-- Heroicon name: solid/location-marker -->
                                    <LocationMarkerIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                    {{ job.county.name }}
                                </p>
                                <p
                                    class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6"
                                >
                                    <CashIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                    Rate:&nbsp;
                                    <span class="font-medium text-gray-900">
                                        {{ job.rate }} &nbsp;
                                    </span>
                                </p>
                                <p
                                    class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6"
                                >
                                    <!-- Heroicon name: solid/location-marker -->
                                    <UserIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                    {{ job.department.name }}
                                </p>
                            </div>
                            <div
                                class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0"
                            >
                                <!-- Heroicon name: solid/calendar -->
                                <ClockIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                <p>
                                    <time datetime="2020-01-07" v-text="job.postedAt">

                                    </time>
                                </p>
                            </div>
                        </div>
                    </div>
                </Link>
            </li>
        </ul>

        <!-- Pagination -->
        <Pagination 
            v-if="jobs.meta.per_page < jobs.meta.total" 
            :links="jobs.links" 
            :meta="jobs.meta" 
        />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { format } from "@/Services/FormattedPrice";
import { ClockIcon, LocationMarkerIcon, CashIcon, UserIcon } from "@heroicons/vue/solid"
import Pagination from "@/components/Pagination"

defineProps({
    jobs: Array,
});

function formatPrice(price) {
    return format(price);
}
</script>
