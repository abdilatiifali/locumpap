<template>
    <div class="overflow-hidden bg-gray-100">
        <div class="relative mx-auto max-w-7xl px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <div
                class="absolute top-0 bottom-0 left-3/4 hidden w-screen bg-gray-50 lg:block"
            />
            <div
                class="mx-auto max-w-prose text-base lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-8"
            >
                <div>
                    <h3
                        class="text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl"
                    >
                        {{ event.title }}
                    </h3>
                    <h2
                        class="mt-2 text-base font-semibold uppercase tracking-wide text-indigo-600"
                    >
                        By {{ event.host }}
                    </h2>
                </div>
            </div>
            <div class="mt-8 lg:grid lg:grid-cols-2 lg:gap-8">
                <div class="relative lg:col-start-2 lg:row-start-1">
                    <svg
                        class="absolute top-0 right-0 -mt-20 -mr-20 hidden lg:block"
                        width="404"
                        height="384"
                        fill="none"
                        viewBox="0 0 404 384"
                        aria-hidden="true"
                    >
                        <defs>
                            <pattern
                                id="de316486-4a29-4312-bdfc-fbce2132a2c1"
                                x="0"
                                y="0"
                                width="20"
                                height="20"
                                patternUnits="userSpaceOnUse"
                            >
                                <rect
                                    x="0"
                                    y="0"
                                    width="4"
                                    height="4"
                                    class="text-gray-200"
                                    fill="currentColor"
                                />
                            </pattern>
                        </defs>
                        <rect
                            width="404"
                            height="384"
                            fill="url(#de316486-4a29-4312-bdfc-fbce2132a2c1)"
                        />
                    </svg>
                    <div
                        class="relative mx-auto max-w-prose text-base lg:max-w-none"
                    >
                        <figure>
                            <div>
                                <img
                                    class="aspect-video rounded-lg object-cover object-center shadow-lg lg:aspect-[12/9]"
                                    :src="event.image"
                                    alt="Whitney leaning against a railing on a downtown street"
                                    width="1184"
                                    height="1376"
                                />

                                <figcaption
                                    class="mt-3 flex items-center text-sm text-gray-500"
                                >
                                    <LocationMarkerIcon
                                        class="h-5 w-5 flex-none text-gray-400"
                                        aria-hidden="true"
                                    />
                                    <span class="ml-2 text-lg">
                                        {{ event.location }} at
                                        <span class="text-red-500">{{
                                            event.date
                                        }}</span>
                                    </span>
                                </figcaption>

                                <Link
                                    :href="
                                        '/events/' + event.slug + '/register'
                                    "
                                    class="mt-4 rounded-full py-3 text-center"
                                >
                                    Enroll Now
                                </Link>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="mt-8 lg:mt-0">
                    <div class="prose" v-html="event.description"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Button from "@/components/Button";
import { LocationMarkerIcon } from "@heroicons/vue/outline";

defineProps({ event: Object });
</script>
