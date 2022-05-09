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
                        <div class="flex items-center justify-between">
                            <p
                                class="truncate text-sm font-medium text-cyan-600"
                                v-text="job.title"
                            ></p>
                            <div class="ml-2 flex flex-shrink-0">
                                <p
                                    :class="{'bg-cyan-100 text-cyan-800': job.type == 'Locum'}"
                                    class="inline-flex rounded-full px-2 bg-red-100 text-xs font-semibold leading-5 text-red-800"
                                    v-text="job.type"
                                ></p>
                            </div>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
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
                                    Rate per hour:&nbsp;
                                    <span class="font-medium text-gray-900">
                                        {{
                                            formatPrice(job.rate_per_hour)
                                        }}&nbsp;
                                    </span>
                                    KES
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
