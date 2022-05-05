<template>
    <div
        class="space-y-4 lg:grid  lg:grid-cols-2 lg:gap-5 lg:space-y-0"
    >
        <div
            v-for="tier in tiers"
            :key="tier.name"
            class="flex flex-col overflow-hidden rounded-lg shadow-lg"
        >
            <div class="bg-white px-6 py-8 sm:p-10 sm:pb-6">
                <div>
                    <h3
                        class="inline-flex rounded-full bg-cyan-100 px-4 py-1 text-sm font-semibold uppercase tracking-wide text-cyan-600"
                        id="tier-standard"
                    >
                        {{ tier.name }}
                    </h3>
                </div>
                <!-- <div
                    class="mt-4 flex items-baseline text-3xl font-extrabold"
                >
                    {{ tier.priceMonthly }}
                    <span
                        class="ml-1 text-sm font-medium text-gray-500"
                    ></span>
                </div> -->
                <p class="mt-5 text-lg text-gray-500">
                    {{ tier.description }}
                </p>
            </div>
            <div
                class="flex flex-1 flex-col justify-between space-y-6 bg-gray-50 px-6 pt-6 pb-8 sm:p-10 sm:pt-6"
            >
                <ul role="list" class="space-y-4">
                    <li
                        v-for="feature in tier.features"
                        :key="feature"
                        class="flex items-start"
                    >
                        <div class="flex-shrink-0">
                            <CheckIcon
                                class="h-6 w-6 text-cyan-500"
                                aria-hidden="true"
                            />
                        </div>
                        <p class="ml-3 text-base text-gray-700">
                            {{ feature }}
                        </p>
                    </li>
                </ul>
                <div class="rounded-md shadow">
                    <Link
                        :href="tier.href"
                        class="flex items-center justify-center rounded-md border border-transparent bg-cyan-700 px-5 py-3 text-base font-medium text-white hover:bg-cyan-900"
                        aria-describedby="tier-standard"
                    >
                        {{ tier.linkText }}
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CheckIcon } from "@heroicons/vue/outline";

const tiers = [
    {
        name: "LocumPap for HCOs",
        href: "/looking-for-a-locum",
        description: "Contact locums with ease.",
        linkText: "I am looking for a locum",
        features: [
            "Free to sign up",
            "3 months free trial version",
            "Access to highly skilled medical professionals",
            "Eliminate expensive recruitment agency fees",
            "Discounted rates for staff trainings",
        ],
    },
    {
        name: "LocumPap For Locums",
        href: "/im-a-locum",
        description: "Allow practices to find you.",
        linkText: "I'm a locum",
        features: [
            "Free to sign up",
            "No commission or fees charges",
            "User friendly platform",
            "Affordable training courses for healthcare workers",
        ],
    },
];
</script>
