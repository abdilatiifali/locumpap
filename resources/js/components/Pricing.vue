<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="mt-16 pb-12 lg:mt-20 lg:pb-32">
        <div class="relative z-0">
            <div class="absolute inset-0 h-5/6 lg:h-2/3" />
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative lg:grid lg:grid-cols-7">
                    <div
                        class="mx-auto max-w-md lg:col-start-1 lg:col-end-3 lg:row-start-2 lg:row-end-3 lg:mx-0 lg:max-w-none"
                    >
                        <div
                            class="flex h-full flex-col overflow-hidden rounded-lg shadow-lg lg:rounded-none lg:rounded-l-lg"
                        >
                            <div class="flex flex-1 flex-col">
                                <div class="bg-white px-6 py-10">
                                    <div>
                                        <h3
                                            class="text-center text-2xl font-medium text-gray-900"
                                            id="tier-hobby"
                                        >
                                            {{ basic.name }}
                                        </h3>
                                        <div
                                            class="mt-4 flex items-center justify-center"
                                        >
                                            <span
                                                class="flex items-start px-3 text-6xl tracking-tight text-gray-900"
                                            >
                                                <span
                                                    class="mt-2 mr-2 text-2xl font-medium"
                                                >
                                                    KES
                                                </span>
                                                <span class="font-bold">{{
                                                    formatedPrice(basic.price)
                                                }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-1 flex-col justify-between border-t-2 border-gray-100 bg-gray-50 p-6 sm:p-10 lg:p-6 xl:p-10"
                                >
                                    <ul role="list" class="space-y-4">
                                        <li
                                            v-for="feature in basic.features"
                                            :key="feature"
                                            class="flex items-start"
                                        >
                                            <div class="flex-shrink-0">
                                                <CheckIcon
                                                    class="h-6 w-6 flex-shrink-0 text-green-500"
                                                    aria-hidden="true"
                                                />
                                            </div>
                                            <p
                                                class="ml-3 text-base font-medium text-gray-500"
                                            >
                                                {{ feature }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="mt-8">
                                        <div class="rounded-lg shadow-md">
                                            <a
                                                href="#"
                                                class="block w-full rounded-lg border border-transparent bg-white px-6 py-3 text-center text-base font-medium text-indigo-600 hover:bg-gray-50"
                                                aria-describedby="tier-hobby"
                                            >
                                                Enroll Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mx-auto mt-10 max-w-lg lg:col-start-3 lg:col-end-6 lg:row-start-1 lg:row-end-4 lg:mx-0 lg:mt-0 lg:max-w-none"
                    >
                        <div class="relative z-10 rounded-lg shadow-xl">
                            <div
                                class="pointer-events-none absolute inset-0 rounded-lg border-2 border-indigo-600"
                                aria-hidden="true"
                            />
                            <div
                                class="absolute inset-x-0 top-0 translate-y-px transform"
                            >
                                <div
                                    class="flex -translate-y-1/2 transform justify-center"
                                >
                                    <span
                                        class="inline-flex rounded-full bg-indigo-600 px-4 py-1 text-sm font-semibold uppercase tracking-wider text-white"
                                    >
                                        Most popular
                                    </span>
                                </div>
                            </div>
                            <div class="rounded-t-lg bg-white px-6 pt-12 pb-10">
                                <div>
                                    <h3
                                        class="text-center text-3xl font-semibold text-gray-900 sm:-mx-6"
                                        id="tier-growth"
                                    >
                                        {{ advanced.name }}
                                    </h3>
                                    <div
                                        class="mt-4 flex items-center justify-center"
                                    >
                                        <span
                                            class="flex items-start px-3 text-6xl tracking-tight text-gray-900 sm:text-6xl"
                                        >
                                            <span
                                                class="mt-2 mr-2 text-2xl font-medium"
                                            >
                                                $
                                            </span>
                                            <span class="font-bold">
                                                {{
                                                    formatedPrice(
                                                        advanced.price
                                                    )
                                                }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="rounded-b-lg border-t-2 border-gray-100 bg-gray-50 px-6 pt-10 pb-8 sm:px-10 sm:py-10"
                            >
                                <ul role="list" class="space-y-4">
                                    <li
                                        v-for="feature in advanced.features"
                                        :key="feature"
                                        class="flex items-start"
                                    >
                                        <div class="flex-shrink-0">
                                            <CheckIcon
                                                class="h-6 w-6 flex-shrink-0 text-green-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <p
                                            class="ml-3 text-base font-medium text-gray-500"
                                        >
                                            {{ feature }}
                                        </p>
                                    </li>
                                </ul>
                                <div class="mt-10">
                                    <div class="rounded-lg shadow-md">
                                        <a
                                            href="#"
                                            class="block w-full rounded-lg border border-transparent bg-indigo-600 px-6 py-4 text-center text-xl font-medium leading-6 text-white hover:bg-indigo-700"
                                            aria-describedby="tier-growth"
                                        >
                                            Enroll Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mx-auto mt-10 max-w-md lg:col-start-6 lg:col-end-8 lg:row-start-2 lg:row-end-3 lg:m-0 lg:max-w-none"
                    >
                        <div
                            class="flex h-full flex-col overflow-hidden rounded-lg shadow-lg lg:rounded-none lg:rounded-r-lg"
                        >
                            <div class="flex flex-1 flex-col">
                                <div class="bg-white px-6 py-10">
                                    <div>
                                        <h3
                                            class="text-center text-2xl font-medium text-gray-900"
                                            id="tier-scale"
                                        >
                                            {{ premium.name }}
                                        </h3>
                                        <div
                                            class="mt-4 flex items-center justify-center"
                                        >
                                            <span
                                                class="flex items-start px-3 text-6xl tracking-tight text-gray-900"
                                            >
                                                <span
                                                    class="mt-2 mr-2 text-2xl font-medium"
                                                >
                                                    KES
                                                </span>
                                                <span class="font-bold">
                                                    {{
                                                        formatedPrice(
                                                            premium.price
                                                        )
                                                    }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-1 flex-col justify-between border-t-2 border-gray-100 bg-gray-50 p-6 sm:p-10 lg:p-6 xl:p-10"
                                >
                                    <ul role="list" class="space-y-4">
                                        <li
                                            v-for="feature in premium.features"
                                            :key="feature"
                                            class="flex items-start"
                                        >
                                            <div class="flex-shrink-0">
                                                <CheckIcon
                                                    class="h-6 w-6 flex-shrink-0 text-green-500"
                                                    aria-hidden="true"
                                                />
                                            </div>
                                            <p
                                                class="ml-3 text-base font-medium text-gray-500"
                                            >
                                                {{ feature }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="mt-8">
                                        <div class="rounded-lg shadow-md">
                                            <a
                                                href="#"
                                                class="block w-full rounded-lg border border-transparent bg-white px-6 py-3 text-center text-base font-medium text-indigo-600 hover:bg-gray-50"
                                                aria-describedby="tier-scale"
                                            >
                                                Enroll Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CheckIcon } from "@heroicons/vue/outline";
import { computed } from "vue";
import { format } from "@/Services/FormattedPrice";

let props = defineProps({
    priceTypes: Array,
});

let basic = computed(() => {
    return props.priceTypes[0];
});

let advanced = computed(() => {
    return props.priceTypes[1];
});

let premium = computed(() => {
    return props.priceTypes[2];
});

const formatedPrice = (price) => format(price);

const hobbyFeatures = [
    "Pariatur quod similique",
    "Sapiente libero doloribus",
    "Vel ipsa esse repudiandae",
];
const scaleFeatures = [
    "Pariatur quod similique",
    "Sapiente libero doloribus",
    "Vel ipsa esse repudiandae",
];
const growthFeatures = [
    "Quia rem est sed impedit magnam",
    "Dolorem vero ratione voluptates",
    "Qui sed ab doloribus voluptatem dolore",
    "Laborum commodi molestiae id et fugiat",
    "Nam ut ipsa nesciunt culpa modi dolor",
];
</script>
