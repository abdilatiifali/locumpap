<template>
    <main class="flex-1 pb-8">
    
      <div class="mt-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>

          <!-- filters -->
          <div class="grid gap-4 mt-4 grid-cols-3">
              <select-filter
                v-model="form.city"
                modelName="Counties"
                :options="$page.props.counties"
            />

            <select-filter
                v-model="form.specialist"
                modelName="Speciality"
                :options="specials"
            />

            <input 
              class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm" 
              ref="availability" 
              placeholder="Dates" 
              v-model="form.availability"
            />

          </div>
          
        </div>

        <!-- <h2 v-if="doctors.length" class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">All Doctors</h2> -->

        <!-- Doctors list (only on smallest breakpoint) -->
        <div class="mt-10 sm:hidden">
          <div class="px-4 sm:px-6">
            <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Available Professionals</h2>
          </div>
          <ul role="list" class="mt-3 border-t border-gray-200 divide-y divide-gray-100">
            <li v-for="doctor in doctors.data" :key="doctor.id">
              <Link :href="'/applicants/' + doctor.id" class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6">
                <span class="flex items-center truncate space-x-3">
                  <img :src="doctor.avatar" class="w-8 h-8 flex-shrink-0 rounded-full" aria-hidden="true" />
                  <span class="font-medium truncate text-sm leading-6">
                    {{ doctor.name }}
                    {{ ' ' }}
                    <span class="truncate font-normal text-gray-500"> {{ doctor.profession }}</span>
                  </span>
                </span>
                <ChevronRightIcon class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
              </Link>
            </li>
          </ul>
          <Pagination 
            v-if="doctors.meta.per_page < doctors.meta.total" 
            :links="doctors.links"
            :meta="doctors.meta"
          />

        </div>

      <!-- Projects table (small breakpoint and up) -->
        <div class="hidden max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 sm:block">
          <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table v-if="doctors.data.length" class="min-w-full">
              <thead>
                <tr class="border-t border-gray-200">
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <span class="lg:pl-2">Name</span>
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profession</th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Speciality</th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qualification</th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Experience</th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                 
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <tr  v-for="doctor in doctors.data" :key="doctor.id">
                  <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                    <div class="flex items-center space-x-3 lg:pl-2">
                      <div class="flex flex-shrink-0 -space-x-1">
                        <img 
                          class="max-w-none h-6 w-6 rounded-full ring-2 ring-white" 
                          :src="doctor.avatar" 
                          :alt="doctor.name" 
                        />
                      </div>
                      <Link :href="'/applicants/' + doctor.id"  class="truncate hover:text-gray-600">
                        <span>
                          {{ doctor.name }}
                        </span>
                      </Link>
                    </div>
                  </td>
                 
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ doctor.profession }}
                  </td>
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ doctor.specialist }}
                  </td>
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ doctor.profile.qualification }}
                  </td>
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ doctor.profile.level }}
                  </td>
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ doctor.profile.phoneNumber }}
                  </td>
                </tr>
              </tbody>
            </table>

            <p v-else class="italic font-medium">
              There is no doctors who are currently available.
            </p>
            <Pagination 
              v-if="doctors.meta.per_page < doctors.meta.total" 
              :links="doctors.links"
              :meta="doctors.meta"
            />

          </div>
        </div>
      </div>
    </main>
</template>

<script setup>
import { ref, onMounted, reactive, watch } from 'vue'

import { ScaleIcon } from '@heroicons/vue/outline'
import {  ChevronRightIcon } from '@heroicons/vue/solid'
import SelectFilter from "@/components/SelectFilter"
import TextInput from "@/components/TextInput"
import Pagination from "@/components/Pagination"
import { Inertia } from "@inertiajs/inertia";
import flatpickr from "flatpickr";
import "flatpickr/dist/themes/airbnb.css"

let props = defineProps({
  doctors: Object,
  specials: Array,
  filters: Object,
})

const availability = ref(null)

const form = reactive({
  city: props.filters.city || 'all',
  specialist: props.filters.specialist || 'all',
  availability: props.filters.availability || 'all'
})

onMounted(() => {
  flatpickr(availability.value, {
    minDate: 'today',
  })
})

const professions = ['doctor', 'nurse', 'dentist']
const departments = ['ICu', 'Inpatient', 'Outpatient']

watch(form, () => {
  Inertia.get("/dashboard/healthcare-professionals", form, {
    preserveState: true,
    preserveScroll: true,
  })
})

</script>

<script>
  import DashboardLayout from '@/Shared/DashboardLayout'

  export default {
    layout: DashboardLayout,
  }
</script>
