<template>
    <Header title="Create new Job" />
    <div
        class="mx-auto flex max-w-7xl justify-center px-4 py-6 pt-16 sm:px-6 lg:px-8"
    >
        <div
            class="w-full bg-white px-4 py-5 pb-12 shadow sm:w-2/3 sm:rounded-lg sm:px-6 sm:pt-6 sm:pb-12"
        >
            <div class="md:grid md:grid-cols-2 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Create Job
                    </h3>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <text-input
                                    :errors="form.errors.title"
                                    label="Title"
                                    v-model="form.title"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <input id="x" type="hidden" />
                                <trix-editor
                                    @keydown.stop
                                    ref="theEditor"
                                    @trix-change="change"
                                    placeholder="description"
                                    input="x"
                                ></trix-editor>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.location"
                                    label="Location"
                                    type="text"
                                    v-model="form.location"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.rate_per_hour"
                                    label="Rate Per Hour"
                                    type="text"
                                    v-model="form.rate_per_hour"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.job_type"
                                    v-model="form.job_type"
                                    label="Job Type"
                                >
                                    <option v-for="job_type in jobTypes">
                                        {{ job_type }}
                                    </option>
                                </select-input>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.county"
                                    v-model="form.county_id"
                                    label="County"
                                >
                                    <option :value="county.id" v-for="county in counties">
                                        {{ county.name }}
                                    </option>
                                </select-input>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.profession"
                                    v-model="form.profession_id"
                                    label="Profession"
                                >
                                    <option :value="profession.id" v-for="profession in professions">
                                        {{ profession.name }}
                                    </option>
                                </select-input>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <select-input
                                    :errors="form.errors.department"
                                    v-model="form.department_id"
                                    label="Department"
                                >
                                    <option :value="department.id" v-for="department in departments">
                                        {{ department.name }}
                                    </option>
                                </select-input>
                            </div>
                        </div>

                        <div class="mt-12">
                            <loading-button
                                :loading="form.processing"
                                :disable="form.processing"
                            >
                                Post Job
                            </loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

import Trix from "trix";
import "trix/dist/trix.css";

import Header from "@/Shared/Header";
import TextInput from "@/components/TextInput";
import SelectInput from "@/components/SelectInput";
import LoadingButton from "@/components/LoadingButton";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
    counties: Array,
    professions: Array,
    departments: Array,
});

const theEditor = ref(null);

const form = useForm({
    title: "",
    description: "",
    rate_per_hour: "",
    job_type: "Full-time",
    county_id: "Nairobi",
    profession_id: "Doctor",
    department_id: "ICU",
    location: "",
});

const jobTypes = ["Full-time", "Part-time"];

const change = () => {
    form.description = theEditor.value.value;
};

const submit = () => form.post("/jobs");
</script>
