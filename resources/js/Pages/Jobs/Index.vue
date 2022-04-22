<template>
    <div class="overflow-hidden mx-auto max-w-3xl  py-10 sm:px-6 lg:max-w-7xl">
        <div class="flex w-full justify-between space-x-4 px-4 md:px-0">
            <select-filter
                modelName="Location"
                :options="counties"
                v-model="form.city"
            />

            <select-filter
                modelName="Department"
                :options="departments"
                v-model="form.department"
            />

            <select-filter
                modelName="Profession"
                :options="professions"
                v-model="form.profession"
            />
        </div>

        <div class="mt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="hidden lg:col-span-2 lg:block xl:col-span-3">
                <Sidebar :counties="counties" />
            </div>

            <main class="px-3 overflow-hidden md:px-0 lg:col-span-9 xl:col-span-9">
                <jobs-listing :jobs="jobs" />
            </main>
        </div>
    </div>
</template>

<script setup>
import Sidebar from "@/components/Sidebar";
import JobsListing from "@/components/JobsListing";
import SelectFilter from "@/components/SelectFilter";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";
import { reactive, watch } from "vue";

const props = defineProps({
    jobs: Array,
    counties: Array,
    departments: Array,
    professions: Array,
    filters: Object,
});

const form = reactive({
    department: props.filters.department || "all",
    city: props.filters.city || "all",
    profession: props.filters.profession || "all",
});

watch(form, () => {
    Inertia.get("/jobs", form, {
        preserveState: true,
        preserveScroll: true,
    });
});
</script>
