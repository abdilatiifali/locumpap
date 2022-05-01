<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="mt-12 pb-12 lg:pb-32">
        <div class="relative z-0">
            <div class="absolute inset-0 h-5/6 lg:h-2/3" />
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative lg:grid lg:grid-cols-2">
                    <div
                        class="mx-auto max-w-md lg:mx-0 lg:max-w-none"
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
                                            Mpesa Payment
                                        </h3>
                                        <img src="/images/mpesa-logo.png">
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
                                                <span class="font-bold">{{ formatedPrice(3000) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-1 flex-col justify-between border-t-2 border-gray-100 bg-gray-50 p-6 sm:p-10 lg:p-6 xl:p-10"
                                >
                                    <ul role="list" class="space-y-4">
                                        <li
                                            v-for="(instruction, index) in mpesaInstructions"
                                            :key="instruction"
                                            class="flex items-start"
                                        >
                                            <div class="flex-shrink-0">
                                                {{ index + 1 }}: 
                                            </div>
                                            <p
                                                class="ml-3 text-base font-medium text-gray-500"
                                            >
                                                {{ instruction }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="mt-8">
                                        <div class="rounded-lg shadow-md">
                                            <a
                                                href="#"
                                                class="block w-full rounded-lg border border-transparent bg-white px-6 py-3 text-center text-base font-medium text-cyan-600 hover:bg-gray-50"
                                                aria-describedby="tier-hobby"
                                            >
                                                Pay Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mx-auto mt-10 max-w-lg  lg:mx-0 lg:mt-0 lg:max-w-none"
                    >
                        <div class="relative z-10 rounded-lg shadow-xl">
                            <div
                                class="pointer-events-none absolute inset-0 rounded-lg border-2 border-cyan-600"
                                aria-hidden="true"
                            />
                            <div
                                class="absolute inset-x-0 top-0 translate-y-px transform"
                            >
                                <div
                                    class="flex -translate-y-1/2 transform justify-center"
                                >
                                    <span
                                        class="inline-flex rounded-full bg-cyan-600 px-4 py-1 text-sm font-semibold uppercase tracking-wider text-white"
                                    >
                                        Prefferd Way to Pay
                                    </span>
                                </div>
                            </div>
                            <div class="rounded-t-lg bg-white px-6 pt-12 pb-10">
                                <div>
                                    <h3
                                        class="text-center text-3xl font-semibold text-gray-900 sm:-mx-6"
                                        id="tier-growth"
                                    >
                                        Pay through Bank
                                    </h3>
                                    <img src="/images/first-community-bank-logo.jpeg">
                                    <div
                                        class="mt-4 flex items-center justify-center"
                                    >
                                        <span
                                            class="flex items-start px-3 text-6xl tracking-tight text-gray-900 sm:text-6xl"
                                        >
                                            <span
                                                class="mt-2 mr-2 text-2xl font-medium"
                                            >
                                                KES 
                                            </span>
                                            <span class="font-bold">
                                                {{ formatedPrice(3000) }}
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
                                        v-for="(instruction, index) in bankInstructions"
                                        :key="instruction"
                                        class="flex items-start"
                                    >
                                        <div class="flex-shrink-0">
                                            {{ index + 1 }}:
                                        </div>
                                        <p
                                            class="ml-3 text-base font-medium text-gray-500"
                                        >
                                            {{ instruction }}
                                        </p>
                                    </li>
                                </ul>
                                <div class="mt-10">
                                    <div class="rounded-lg shadow-md">
                                        <a
                                            href="#"
                                            class="block w-full rounded-lg border border-transparent bg-cyan-600 px-6 py-4 text-center text-xl font-medium leading-6 text-white hover:bg-indigo-700"
                                            aria-describedby="tier-growth"
                                        >
                                            Pay
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
</template>

<script setup>
import { CheckIcon } from "@heroicons/vue/outline";
import { computed } from "vue";
import { format } from "@/Services/FormattedPrice";


const formatedPrice = (price) => format(price);

const mpesaInstructions = [
    "Go to mpesa menu on your phone",
    "Select Pay Bill option",
    "Enter the following business number: 919700",
    "Enter 0017017901 as the Account No",
    "Enter total Amount (KES 3,000.00)",
    "Enter Your M-pesa PIN then send it",
    "You will recieve a transaction confirmation SMS from M-pesa",
    "Your Payment will be automatically processed in the system",
];

const bankInstructions = [
    "Visit Any First community Branch",
    "Enter branch name as FCB MIHRAB",
    "Enter Account number 0017117901",
    "Enter Account Name: Locum Pap Limited",
    "Enter Amount Being Paid (KES 3,000.00)",
    "Deposit Your Money",
];

</script>
