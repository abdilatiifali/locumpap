
<template>

  <div class="min-h-full">

    <main class="py-10">
      <!-- Page header -->
      <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <img class="h-16 w-16 rounded-full" :src="applicant.avatar" alt="User profile Photo" />
              <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true" />
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900" v-text="applicant.name"></h1>
            <p class="text-sm font-medium text-gray-500">Applied for <a href="#" class="text-gray-900">
              General Dentist
            </a> on <time datetime="2020-08-25">August 25, 2020</time></p>
          </div>
        </div>
        <!-- <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
          <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">Disqualify</button>
          <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">Advance to offer</button>
        </div> -->
      </div>

      <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
          <!-- Description list-->
          <section class="px-4 md:px-0" aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900">Applicant Information</h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Application for</dt>
                    <dd class="mt-1 text-sm text-gray-900">General Dentist</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.email"></dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Salary expectation</dt>
                    <dd class="mt-1 text-sm text-gray-900">Negotiable</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profile.phoneNumber"></dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Profession</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profession"></dd>
                  </div>

                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Profesional Registration Number</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profile.registrationNumber"></dd>
                  </div>

                  <div class="sm:col-span-1" v-if="applicant.profile.about">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profile.about"></dd>
                  </div>

                  <div class="sm:col-span-1" v-if="applicant.profile.about">
                    <dt class="text-sm font-medium text-gray-500">Available</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ applicant.profile.availability }}
                    </dd>
                  </div>

                  <div class="sm:col-span-2" v-if="applicant.profile.attachments">
                    <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                        <li v-for="attachment in applicant.profile.attachments" :key="attachment.name" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                          <div class="w-0 flex-1 flex items-center">
                            <PaperClipIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                            <a :href="attachment.name" class="ml-2 flex-1 w-0 truncate">
                              {{ attachment.name }}
                            </a>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a :href="attachment.href" class="font-medium text-blue-600 hover:text-blue-500"> Download </a>
                          </div>
                        </li>
                      </ul>
                    </dd>
                  </div>

                </dl>
              </div>
             
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

let props = defineProps({
  applicant: Object
})

onMounted(() => console.log(props.applicant.profile.attachments))

import { PaperClipIcon } from '@heroicons/vue/solid'


</script>
