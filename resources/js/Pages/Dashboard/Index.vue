<template>
    <main class="flex-1 pb-8">
    
      <div class="mt-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
          <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Card -->
            <div v-for="card in cards" :key="card.name" class="bg-white overflow-hidden shadow rounded-lg">
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0">
                    <component :is="card.icon" class="h-6 w-6 text-gray-400" aria-hidden="true" />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ card.name }}
                      </dt>
                      <dd>
                        <div class="text-lg font-medium text-gray-900">
                          {{ card.amount }}
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                  <a :href="card.href" class="font-medium text-cyan-700 hover:text-cyan-900"> View all </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h2 v-if="jobs.length" class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">Recent Jobs You Posted</h2>

        <!-- Projects list (only on smallest breakpoint) -->
        <div class="mt-10 sm:hidden">
          <div class="px-4 sm:px-6">
            <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Jobs</h2>
          </div>
          <ul role="list" class="mt-3 border-t border-gray-200 divide-y divide-gray-100">
            <li v-for="job in jobs" :key="job.id">
              <Link :href="'/jobs/' + job.slug" class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6">
                <span class="flex items-center truncate space-x-3">
                  <span :class="[job.bgColorClass, 'w-2.5 h-2.5 flex-shrink-0 rounded-full']" aria-hidden="true" />
                  <span class="font-medium truncate text-sm leading-6">
                    {{ job.title }}
                    {{ ' ' }}
                    <span class="truncate font-normal text-gray-500">in {{ job.organization }}</span>
                  </span>
                </span>
                <ChevronRightIcon class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
              </Link>
            </li>
          </ul>
        </div>

      <!-- Projects table (small breakpoint and up) -->
        <div class="hidden max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 sm:block">
          <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table v-if="jobs.length" class="min-w-full">
              <thead>
                <tr class="border-t border-gray-200">
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <span class="lg:pl-2">Job</span>
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicants</th>
                  <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Posted At</th>
                
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <tr  v-for="job in jobs" :key="job.id">
                  <td class="px-6 py-3 max-w-0 w-full whitespace-nowrap text-sm font-medium text-gray-900">
                    <div class="flex items-center space-x-3 lg:pl-2">
                      <div 
                        class="bg-pink-500 flex-shrink-0 w-2.5 h-2.5 rounded-full" 
                        aria-hidden="true" 
                      />
                      <Link :href="'/jobs/' + job.slug"  class="truncate hover:text-gray-600">
                        <span>
                          {{ job.title }}
                          {{ ' ' }}
                          <span class="text-gray-500 font-normal">in {{ job.organization }}</span>
                        </span>
                      </Link>
                    </div>
                  </td>
                  <td class="px-6 py-3 text-sm text-gray-500 font-medium">
                    <div class="flex items-center space-x-2">
                      <div class="flex flex-shrink-0 -space-x-1">
                        <img v-for="applicant in job.applicants" :key="applicant.id" class="max-w-none h-6 w-6 rounded-full ring-2 ring-white" :src="applicant.avatar" :alt="applicant.name" />
                      </div>
                      <span v-if="job.totalApplicants > job.applicants.length" class="flex-shrink-0 text-xs leading-5 font-medium">+{{ job.totalApplicants - job.applicants.length }}</span>
                    </div>
                  </td>
                  <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                    {{ job.postedAt }}
                  </td>
                </tr>
              </tbody>
            </table>

            <p v-else class="italic font-medium">
              You didn't post any jobs yet
            </p>
          </div>
        </div>

        
      </div>
    </main>
</template>

<script setup>
import { ref } from 'vue'

import { ScaleIcon } from '@heroicons/vue/outline'
import {  ChevronRightIcon } from '@heroicons/vue/solid'

defineProps({
  jobs: Array,
})

const cards = [
  { name: 'Job Posted This month', href: '#', icon: ScaleIcon, amount: '50' },
  { name: 'Job Posted This Week', href: '#', icon: ScaleIcon, amount: '30' },
  { name: 'Job Posted past year', href: '#', icon: ScaleIcon, amount: '100' },
  // More items...
]

</script>

<script>
  import DashboardLayout from '@/Shared/DashboardLayout'

  export default {
    layout: DashboardLayout,
  }
</script>