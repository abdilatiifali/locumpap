<template>
	<div class="py-8">
		<div class="flex justify-between items-center">
	      <h2 class="font-extrabold text-xl">Applicants for this job</h2>
	  </div>
    <ul role="list" class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <li  v-for="applicant in applicants" :key="applicant.id" class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
        <Link :href="'/applicants/'+ applicant.id">
          <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 truncate">
              <div class="flex items-center space-x-3">
                <h3 class="text-gray-900 text-sm font-medium truncate">{{ applicant.name }}</h3>
                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{ applicant.profile.qualification }}</span>
              </div>
              <span class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">{{ applicant.profession }}</span>

              <p class="mt-1 text-gray-500 text-sm truncate">
                available at: {{ applicant.profile.availability }}
              </p>
            </div>
            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" :src="applicant.avatar" alt="User Avatar" />
          </div>
          <div>
            <div class="-mt-px flex divide-x divide-gray-200">
              <div class="w-0 flex-1 flex">
                <a :href="`mailto:${applicant.email}`" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                  <MailIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                  <span class="ml-3">Email</span>
                </a>
              </div>
              <div class="-ml-px w-0 flex-1 flex">
                <a :href="`tel:10011001`" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                  <PhoneIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                  <span class="ml-3">Call</span>
                </a>
              </div>
            </div>
          </div>
        </Link>
      </li>
 
    </ul>
	</div>
</template>

<script setup>
import { MailIcon, PhoneIcon } from '@heroicons/vue/solid'
import { reactive, watch } from "vue";
import SelectFilter from "@/components/SelectFilter"
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
  applicants: Array,
  // professions: Array,
  // filters: Object,
})

// const form = reactive({
//   profession: props.filters.profession || 'All',
// })

// watch(form, () => {
//     Inertia.get("/applicants", form, {
//         preserveState: true,
//         preserveScroll: true,
//     });
// });
</script>