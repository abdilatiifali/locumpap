<template>
    <div class="overflow-hidden mx-auto max-w-3xl px-4 pt-10 pb-16 sm:px-6 lg:max-w-7xl">
        <div class="flex w-full justify-between space-x-4  md:px-0">
            <select-filter
                :options="$page.props.counties"
                v-model="form.city"
                modelName="Counites"
            />

            <select-filter
                :options="departments"
                v-model="form.department"
                modelName="Departments"
            />

            <select-filter
                :options="professions"
                v-model="form.profession"
                modelName="Professions"
            />
        </div>

        <div class="mt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="hidden lg:col-span-2 lg:block xl:col-span-3">
                <Sidebar  />
            </div>

            <main class="md:px-0 lg:col-span-9 xl:col-span-9">
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
    jobs: Object,
    departments: Array,
    professions: Array,
    filters: Object,
});

const form = reactive({
    department: props.filters.department || "all",
    city: props.filters.city || "all",
    profession: props.filters.profession || "all",
    type: props.filters.type || 'all',
});

watch(form, () => {
    Inertia.get("/jobs", form, {
        preserveState: true,
        preserveScroll: true,
    });
});
</script>
