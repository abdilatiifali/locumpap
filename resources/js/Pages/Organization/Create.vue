<template>
    <Header title="Register as a Healthcare Organisation" />
    <div class="bg-gray-100 pb-12">
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
                                        :errors="form.errors.organization_name"
                                        label="Organisation Name"
                                        v-model="form.organization_name"
                                    />
                                </div>
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
                                        :errors="
                                            form.errors.password_confirmation
                                        "
                                        label="Confirm Password"
                                        type="password"
                                        v-model="form.password_confirmation"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <text-input
                                        :errors="form.errors.phone_number"
                                        label="Phone Number"
                                        type="number"
                                        v-model="form.phone_number"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <select-input
                                        :errors="form.errors.organization_type"
                                        v-model="form.organization_type"
                                        class="uppercase"
                                        label="Organisation Type"
                                    >
                                        <option
                                            v-for="organization in organizationTypes"
                                        >
                                            {{ organization }}
                                        </option>
                                    </select-input>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <autocomplate-place  
                                        @place-changed="placeChanged" 
                                        :errors="form.errors.address"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <text-input
                                        :errors="form.errors.county"
                                        label="County"
                                        v-model="form.county"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <text-input
                                        :errors="form.errors.city"
                                        label="City"
                                        v-model="form.city"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <text-input
                                        :errors="form.errors.post_code"
                                        label="Post Code"
                                        v-model="form.post_code"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <text-input
                                        :errors="form.errors.registration_number"
                                        label="Professional Registration Number"
                                        v-model="form.registration_number"
                                    />
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
    </div>
</template>

<script setup>
import Header from "@/Shared/Header";
import TextInput from "@/components/TextInput";
import SelectInput from "@/components/SelectInput";
import LoadingButton from "@/components/LoadingButton";
import AutocomplatePlace from "@/components/AutocomplatePlace"
import { useForm } from "@inertiajs/inertia-vue3";


const organizationTypes = [
    "Dental Practice",
    "General Practice",
    "Hospital",
    "Locum agency",
    "Opticians",
];

const form = useForm({
    organization_name: "",
    first_name: "",
    last_name: "",
    email: "",
    email_confirmation: "",
    password: "",
    password_confirmation: "",
    phone_number: "",
    organization_type: "",
    organization: true,
    address: "",
    county: "",
    city: "",
    post_code: "",
    registration_number: "",
});

const placeChanged = place => form.address = place
const submit = () => form.post("/practices");

</script>
