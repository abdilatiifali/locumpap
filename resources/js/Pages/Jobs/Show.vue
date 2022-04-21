<template>
    <div class="min-h-screen mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="w-full md:flex">
            <div class="w-full md:w-3/4">
                <div
                    class="rounded border-t-8 border-cyan-500 bg-white shadow-xl"
                >
                    <div class="border-b">
                        <div class="py-6 px-12">
                            <div class="flex items-baseline">
                                <div>
                                    <h1
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        {{ job.organization.name }}
                                    </h1>
                                    <!-- <p class="mt-2 text-gray-600">
                                        Grow your short term rental Business
                                    </p> -->
                                </div>

                                <div class="ml-auto">
                                    <p
                                        class="flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6"
                                    >
                                        <!-- Heroicon name: solid/location-marker -->
                                        <svg
                                            class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ job.location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-6 px-12">
                        <div class="prose mb-12" v-html="job.description"></div>

                        <Link
                            v-if="!alreadyApplied && $page.props.user.is.doctor"
                            @click="go"
                            class="block w-full rounded-lg bg-cyan-500 py-4 px-8 text-center text-sm font-semibold uppercase text-white shadow-lg hover:bg-cyan-600 hover:text-white"
                        >
                            Apply Now
                        </Link>

                        <p v-if="alreadyApplied">
                            You have Already applied this job
                        </p>
                    </div>
                </div>
            </div>

          
       </div>

        <div v-if="applicants.length" class="mt-12">
            <applicants v-if="creator" :applicants="applicants" />
        </div>

    </div>
</template>

<script setup>
import Applicants from '@/components/Applicants'
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import { onMounted, computed } from 'vue'

let props = defineProps({
    job: Object,
    alreadyApplied: Boolean,
    applicants: Array,
})

const go = () => {
    localStorage.setItem("job", props.job.slug)
    Inertia.post("/apply", {
        job: props.job.slug
    })
}

onMounted(() => console.log(usePage().props.value.user.is.doctor))

const creator = computed(() => {
 return usePage().props.value.user.organizationId === props.job.organization_id
})

</script>
