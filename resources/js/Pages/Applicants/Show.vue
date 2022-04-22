
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
                    <dt class="text-sm font-medium text-gray-500">Profesional Registraion Number</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profile.registrationNumber"></dd>
                  </div>

                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900" v-text="applicant.profile.about"></dd>
                  </div>

                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Available</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ applicant.profile.availability }}
                    </dd>
                  </div>

                  <div class="sm:col-span-2">
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
              <!-- <div>
                <a href="#" class="block bg-gray-50 text-sm font-medium text-gray-500 text-center px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">Read full application</a>
              </div> -->
            </div>
          </section>

          <!-- Comments-->
          <!-- <section aria-labelledby="notes-title">
            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
              <div class="divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="notes-title" class="text-lg font-medium text-gray-900">Notes</h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                  <ul role="list" class="space-y-8">
                    <li v-for="comment in comments" :key="comment.id">
                      <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                          <img class="h-10 w-10 rounded-full" :src="`https://images.unsplash.com/photo-${comment.imageId}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80`" alt="" />
                        </div>
                        <div>
                          <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900">{{ comment.name }}</a>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>{{ comment.body }}</p>
                          </div>
                          <div class="mt-2 text-sm space-x-2">
                            <span class="text-gray-500 font-medium">{{ comment.date }}</span>
                            {{ ' ' }}
                            <span class="text-gray-500 font-medium">&middot;</span>
                            {{ ' ' }}
                            <button type="button" class="text-gray-900 font-medium">Reply</button>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                  <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
                  </div>
                  <div class="min-w-0 flex-1">
                    <form action="#">
                      <div>
                        <label for="comment" class="sr-only">About</label>
                        <textarea id="comment" name="comment" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md" placeholder="Add a note" />
                      </div>
                      <div class="mt-3 flex items-center justify-between">
                        <a href="#" class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                          <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                          <span> Some HTML is okay. </span>
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Comment</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section> -->
        </div>

        
      </div>
    </main>
  </div>
</template>

<script setup>

defineProps({
  applicant: Object
})

import {
  CheckIcon,
  PaperClipIcon,
  QuestionMarkCircleIcon,
  ThumbUpIcon,
  UserIcon,
} from '@heroicons/vue/solid'

const user = {
  name: 'Whitney Francis',
  email: 'whitney@example.com',
  imageUrl:
    'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80',
}

const attachments = [
  { name: 'resume_front_end_developer.pdf', href: '#' },
  { name: 'coverletter_front_end_developer.pdf', href: '#' },
]


</script>