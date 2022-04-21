<template>
    <div class="flex min-h-full bg-white">
        <div
            class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img
                        class="h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark-cyan-600.svg"
                        alt="Workflow"
                    />
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Register New Account
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <text-input
                                    v-model="form.name"
                                    field="name"
                                    type="text"
                                    :errors="form.errors.name"
                                    required
                                >
                                    Name
                                </text-input>
                            </div>

                            <div>
                                <text-input
                                    v-model="form.email"
                                    field="email"
                                    type="email"
                                    :errors="form.errors.email"
                                    required
                                >
                                    Email
                                </text-input>
                            </div>

                            <div class="space-y-1">
                                <text-input
                                    v-model="form.password"
                                    field="password"
                                    type="password"
                                    :errors="form.errors.password"
                                    required
                                >
                                    Password
                                </text-input>
                            </div>
                            <div class="space-y-1">
                                <text-input
                                    v-model="form.password_confirmation"
                                    field="confirm-password"
                                    type="password"
                                    :errors="form.errors.password_confirmation"
                                    required
                                >
                                    Confirm Password
                                </text-input>
                            </div>

                            <div class="flex items-center">
                                <div class="w-2/3">
                                    <Button :disable="form.processing"
                                        >Register</Button
                                    >
                                </div>

                                <Link class="ml-auto" href="/login">Login</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img
                class="absolute inset-0 h-full w-full object-cover"
                src="https://media.istockphoto.com/photos/man-applying-for-a-job-on-the-internet-picture-id475352876?b=1&k=20&m=475352876&s=170667a&w=0&h=_rPqnILkaNt9Dl_UaUbHLycp03X8sYoV1pCxJwvfaOg="
                alt=""
            />
        </div>
    </div>
</template>

<script setup>
import TextInput from "@/components/TextInput.vue";
import Button from "@/components/Button";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => form.post("/register");
</script>
