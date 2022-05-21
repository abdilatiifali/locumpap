<template>
    <div class="flex min-h-full bg-gray-100">
        <div
            class="flex flex-1 flex-col justify-center pt-16 pb-32 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
        
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Sign in to your account
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <text-input
                                    label="Email"
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
                                    label="Password"
                                    v-model="form.password"
                                    field="password"
                                    type="password"
                                    :errors="form.errors.password"
                                    required
                                >
                                    Password
                                </text-input>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <Link
                                        href="/register"
                                        class="font-medium text-cyan-600 hover:text-cyan-500"
                                    >
                                        Register
                                    </Link>
                                </div>

                                <div class="text-sm">
                                    <Link
                                        href="/forgot-password"
                                        class="font-medium text-cyan-900 hover:text-cyan-800"
                                    >
                                        Forgot your password?
                                    </Link>
                                </div>
                            </div>

                            <div>
                                <Button :disable="form.processing"
                                    >Sign In</Button
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
                :src="loginImage"
                alt="Man applying job"
            />
        </div>
    </div>
</template>

<script setup>
import TextInput from "@/components/TextInput.vue";
import Button from "@/components/Button";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
    loginImage: String
})

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.transform(data => ({
        ...data,
    })).post('/login', {
        onFinish: () => form.reset('password'),
    });
};

</script>
