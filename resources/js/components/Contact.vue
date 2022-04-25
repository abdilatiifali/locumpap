<template>
    <div id="contact" class="relative border-t bg-white">
        <div class="absolute inset-0">
            <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50" />
        </div>
        <div class="relative mx-auto max-w-7xl lg:grid lg:grid-cols-5">
            <div
                class="bg-gray-50 py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12"
            >
                <div class="mx-auto max-w-lg">
                    <h2
                        class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl"
                    >
                        Get in touch
                    </h2>
                    <p class="mt-3 text-lg leading-6 text-gray-500">
                        Have a question that you want to ask? You can send us
                        email or if urgent you can call us. We will get back you
                        as soon as possible
                    </p>
                    <dl class="mt-8 text-base text-gray-500">
                        <div>
                            <dt class="sr-only">Location</dt>
                            <dd class="flex">
                                <LocationMarkerIcon
                                    class="h-6 w-6 flex-shrink-0 text-gray-400"
                                    aria-hidden="true"
                                />
                                <span class="ml-3"
                                    >Mombasa Central Business District -
                                    Kenya</span
                                >
                            </dd>
                        </div>

                        <div class="mt-6">
                            <dt class="sr-only">Phone number</dt>
                            <dd class="flex">
                                <PhoneIcon
                                    class="h-6 w-6 flex-shrink-0 text-gray-400"
                                    aria-hidden="true"
                                />
                                <a href="tel:+254 (796 001 001)" class="ml-3"> +254 (796 001 001) </a>
                            </dd>
                        </div>
                        <div class="mt-3">
                            <dt class="sr-only">Email</dt>
                            <dd class="flex">
                                <MailIcon
                                    class="h-6 w-6 flex-shrink-0 text-gray-400"
                                    aria-hidden="true"
                                />
                                <a href="mailto:info@locumpap.com" class="ml-3">
                                    info@locumpap.com
                                </a>
                            </dd>
                        </div>
                       
                    </dl>
                    <p class="mt-6 text-base text-gray-500">
                        Looking for careers?
                        {{ " " }}
                        <Link
                            href="/jobs"
                            class="font-medium text-gray-700 underline"
                            >View all job openings</Link
                        >.
                    </p>
                </div>
            </div>
            <div
                class="bg-white py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12"
            >
                <div class="mx-auto max-w-lg lg:max-w-none">
                    <form
                        @submit.prevent="submit"
                        class="grid grid-cols-1 gap-y-6"
                    >
                        <div>
                            <text-input :errors="form.errors.name" v-model="form.name" class="py-3 px-4" label="Full Name" />
                        </div>
                        <div>
                            <text-input :errors="form.errors.email" v-model="form.email" type="email" label="Email Address" />
                        </div>
                        <div>
                            <text-input :errors="form.errors.phone" v-model="form.phone" label="Phone" />
                        </div>

                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <textarea

                                v-model="form.message"
                                id="message"
                                name="message"
                                rows="4"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                                placeholder="Message"
                            />
                            <p class="mt-1 italic text-red-500" v-if="form.errors.message">
                                {{ form.errors.message }}
                            </p>
                        </div>
                        <loading-button class="inline-flex text-base font-medium justify-center w-1/5  py-3 px-6" :loading="form.processing">Submit</loading-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import TextInput from '@/components/TextInput'
import LoadingButton from '@/components/LoadingButton'
import { useForm } from "@inertiajs/inertia-vue3";

import {
    MailIcon,
    PhoneIcon,
    LocationMarkerIcon,
} from "@heroicons/vue/outline";

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
})

const submit = () => form.post('/support', {preserveScroll: true});

</script>
