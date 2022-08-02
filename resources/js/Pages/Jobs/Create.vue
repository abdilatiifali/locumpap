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
                               <autocomplate-place  
                                    @place-changed="placeChanged" 
                                    :errors="form.errors.location"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <text-input
                                    :errors="form.errors.rate"
                                    label="Rate"
                                    type="text"
                                    v-model="form.rate"
                                />
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
                                    :errors="form.errors.job_type"
                                    v-model="form.job_type"
                                    label="Job Type"
                                >
                                    <option v-for="job_type in jobTypes">
                                        {{ job_type }}
                                    </option>
                                </select-input>
                            </div>

                            <div 
                                v-if="form.job_type == 'Locum'" 
                                class="col-span-6 sm:col-span-3"
                            >
                                <div>
                                    <label
                                        for="start_at"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Start At
                                    </label>
                                    <input 
                                        placeholder="Start At" 
                                        ref="startAt"
                                        v-model="form.start_at"
                                        class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                                    >
                                     <p 
                                        class="mt-1 italic text-red-500" 
                                        v-if="form.errors.start_at"
                                    >
                                        {{ form.errors.start_at }}
                                    </p>
                                    
                                </div>

                            </div>

                            <div 
                                v-if="form.job_type == 'Locum'"
                                class="col-span-6 sm:col-span-3"
                            >
                                <div>
                                    <label
                                        for="end_at"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        End At
                                    </label>
                                    <input 
                                        placeholder="End At" 
                                        ref="endAt"
                                        v-model="form.end_at"
                                        class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                                    >
                                    <p 
                                        class="mt-1 italic text-red-500" 
                                        v-if="form.errors.end_at"
                                    >
                                        {{ form.errors.end_at }}
                                    </p>
                                </div>
                            
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

                        <div class="mt-4">
                            <label
                                for="deadline"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Deadine At
                            </label>
                            <input 
                                placeholder="Deadline At" 
                                ref="deadline"
                                v-model="form.deadline_at"
                                class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                            >
                            <p 
                                class="mt-1 italic text-red-500" 
                                v-if="form.errors.deadline_at"
                            >
                                {{ form.errors.deadline_at }}
                            </p>
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
import { ref, onMounted } from "vue";
import flatpickr from "flatpickr"
import Trix from "trix";
import "trix/dist/trix.css";
import "flatpickr/dist/themes/airbnb.css"

import Header from "@/Shared/Header";
import TextInput from "@/components/TextInput";
import SelectInput from "@/components/SelectInput";
import LoadingButton from "@/components/LoadingButton";
import AutocomplatePlace from "@/components/AutocomplatePlace";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
    counties: Array,
    professions: Array,
    departments: Array,
});

const theEditor = ref(null);
const startAt = ref(null);
const endAt = ref(null);
const deadline = ref(null);

const form = useForm({
    title: "",
    description: "",
    rate: "",
    job_type: "Locum",
    county_id: "Nairobi",
    profession_id: "Doctor",
    department_id: "ICU",
    location: "",
    start_at: '',
    end_at: '',
    deadline_at: '',
});

const jobTypes = ["Locum", "Permanent"];

const endDatePicker = () => flatpickr(endAt.value)

onMounted(() => {
    flatpickr(startAt.value, {
        minDate: 'today',
    })

    flatpickr(endAt.value, {
        minDate: 'today',
    })

    flatpickr(deadline.value, {
        minDate: 'today',
    })

})

const change = () => {
    form.description = theEditor.value.value;
};

const placeChanged = place => form.location = place

const submit = () => form.post("/jobs");

</script>
