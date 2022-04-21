<template>
    <div
        class="relative bg-gray-100 px-4 pt-4 pb-20 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28"
    >
        <div class="absolute inset-0">
            <div class="h-1/3 bg-gray-100 sm:h-2/3" />
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div
                class="ax-w-lg mx-auto grid gap-5 lg:max-w-none lg:grid-cols-3"
            >
                <div
                    v-for="event in events"
                    :key="event.title"
                    class="flex flex-col overflow-hidden rounded-lg shadow-lg"
                >
                    <div class="flex-shrink-0 border">
                        <img
                            class="h-48 w-full object-cover"
                            :src="event.image"
                            alt=""
                        />
                    </div>
                    <div
                        class="flex flex-1 flex-col justify-between bg-white p-6"
                    >
                        <div class="flex-1">
                            <Link
                                :href="'/events/' + event.slug"
                                class="mt-2 block"
                            >
                                <p class="text-xl font-semibold text-gray-900">
                                    {{ event.title }}
                                </p>
                                <p
                                    class="mt-2 text-sm font-medium text-red-600"
                                >
                                    <a
                                        :href="'/events/' + event.slug"
                                        class="hover:underline"
                                    >
                                        {{ event.date }}
                                    </a>
                                </p>
                                <p
                                    class="mt-3 flex items-center text-base text-gray-500"
                                >
                                    <LocationMarkerIcon
                                        class="h-4 w-4 flex-shrink-0 text-gray-400"
                                        aria-hidden="true"
                                    />
                                    <span class="ml-2">{{
                                        event.location
                                    }}</span>
                                </p>

                                <p
                                    class="mt-2 text-sm font-semibold text-gray-900"
                                >
                                    {{ event.host }}
                                </p>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { format } from "@/Services/FormattedPrice";
import { onMounted } from "vue";
import { LocationMarkerIcon } from "@heroicons/vue/outline";

defineProps({
    events: Array,
});

const formatedPrice = (price) => format(price);
</script>
