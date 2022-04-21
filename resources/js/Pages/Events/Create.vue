<template>
    <div class="flex min-h-full">
        <div
            class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Fill Your information to Enroll Now
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Your Name</label
                                >
                                <div class="mt-1">
                                    <text-input
                                        :errors="form.errors.name"
                                        type="name"
                                        v-model="form.name"
                                        field="name"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <text-input
                                        :errors="form.errors.email"
                                        type="email"
                                        v-model="form.email"
                                        field="email"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    for="number"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Your Phone Number
                                </label>

                                <div class="mt-1">
                                    <text-input
                                        :errors="form.errors.number"
                                        type="number"
                                        v-model="form.number"
                                        field="number"
                                    />
                                </div>
                            </div>
                            <div>
                                <Button :disable="form.processing" type="submit"
                                    >Enroll Now</Button
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img
                class="absolute inset-0 h-full w-full object-cover"
                :src="event.image"
                alt=""
            />
        </div>
    </div>
</template>

<script setup>
import TextInput from "@/components/TextInput";
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "@/components/Button";

let props = defineProps({
    event: Object,
});

const form = useForm({
    name: "",
    email: "",
    number: "",
    eventId: props.event.id,
});

const submit = () => form.post("/events");
</script>
