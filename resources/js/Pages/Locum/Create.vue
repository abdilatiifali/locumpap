<template>
    <Header title="Register as a Locum" />

    <div
        class="mx-auto flex max-w-7xl justify-center px-4 py-6 pt-16 sm:px-6 lg:px-8"
    >
        <div
            class="w-full bg-white px-4 py-5 pb-12 shadow sm:w-2/3 sm:rounded-lg sm:px-6 sm:pt-6 sm:pb-12"
        >
            <div class="md:grid md:grid-cols-2 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Your Details
                    </h3>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.first_name"
                                    label="First Name"
                                    v-model="form.first_name"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.last_name"
                                    label="Last Name"
                                    v-model="form.last_name"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.email"
                                    label="Email Address"
                                    type="email"
                                    v-model="form.email"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.email_confirmation"
                                    label="Re enter Email"
                                    type="email"
                                    v-model="form.email_confirmation"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.password"
                                    label="Password"
                                    type="password"
                                    v-model="form.password"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.password_confirmation"
                                    label="Confirm Password"
                                    type="password"
                                    v-model="form.password_confirmation"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.mobile_number"
                                    label="Mobile Number"
                                    type="number"
                                    v-model="form.mobile_number"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.registration_number"
                                    label="Professional Registration Number"
                                    type="number"
                                    v-model="form.registration_number"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.professionId"
                                    v-model="form.professionId"
                                    class="uppercase"
                                    label="Profession"
                                >
                                    <option 
                                        :value="profession.id" 
                                        v-for="profession in professions" 
                                        :key="profession.id"
                                    >
                                        {{ profession.name }}
                                    </option>
                                </select-input>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.countyId"
                                    v-model="form.countyId"
                                    class="uppercase"
                                    label="Current County"
                                >
                                    <option 
                                        :value="county.id" 
                                        v-for="county in $page.props.counties" 
                                        :key="county.id"
                                    >
                                        {{ county.name }}
                                    </option>
                                </select-input>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <select-input
                                    :errors="form.errors.specialityId"
                                    v-model="form.specialityId"
                                    class="uppercase"
                                    label="Speciality"
                                >
                                    <option 
                                        :value="special.id" 
                                        v-for="special in specials" 
                                        :key="special.id"
                                    >
                                        {{ special.name }}
                                    </option>
                                </select-input>
                            </div>

                        </div>

                        <div class="mt-12">
                            <loading-button
                                :loading="form.processing"
                                :disable="form.processing"
                                >Register</loading-button
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from "@/Shared/Header";
import TextInput from "@/components/TextInput";
import SelectInput from "@/components/SelectInput";
import LoadingButton from "@/components/LoadingButton";
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
    professions: Array,
    specials: Array,
});

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    email_confirmation: "",
    password: "",
    password_confirmation: "",
    mobile_number: "",
    registration_number: "",
    professionId: "",
    countyId: "",
    specialityId: "",
    organization: false,
});

const submit = () => form.post("/locum");

</script>
