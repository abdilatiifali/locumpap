<template>
  <div>
    <Disclosure as="div" class="relative bg-cyan-700 pb-32 overflow-hidden" v-slot="{ open }">
     
      <div aria-hidden="true" :class="[open ? 'bottom-0' : 'inset-y-0', 'absolute inset-x-0 left-1/2 transform -translate-x-1/2 w-full overflow-hidden lg:inset-y-0']">
        <div class="absolute inset-0 flex">
          <div class="h-full w-1/2" style="background-color: #0a527b" />
          <div class="h-full w-1/2" style="background-color: #065d8c" />
        </div>
        <div class="relative flex justify-center">
          <svg class="flex-shrink-0" width="1750" height="308" viewBox="0 0 1750 308" xmlns="http://www.w3.org/2000/svg">
            <path d="M284.161 308H1465.84L875.001 182.413 284.161 308z" fill="#0369a1" />
            <path d="M1465.84 308L16.816 0H1750v308h-284.16z" fill="#065d8c" />
            <path d="M1733.19 0L284.161 308H0V0h1733.19z" fill="#0a527b" />
            <path d="M875.001 182.413L1733.19 0H16.816l858.185 182.413z" fill="#0a4f76" />
          </svg>
        </div>
      </div>
      <header class="relative py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold text-white">Settings</h1>
        </div>
      </header>
    </Disclosure>

    <main class="relative -mt-32">
      <div class="max-w-screen-xl mx-auto pb-6 px-4 sm:px-6 lg:pb-16 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
          <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
            <aside class="py-6 lg:col-span-3">
              <nav class="space-y-1">
                <a v-for="item in subNavigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">
                  <component :is="item.icon" :class="[item.current ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">
                    {{ item.name }}
                  </span>
                </a>
              </nav>
            </aside>

            <form @submit.prevent="submit" class="divide-y divide-gray-200 lg:col-span-9" action="#" method="POST">
              <!-- Profile section -->
              <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                  <h2 class="text-lg leading-6 font-medium text-gray-900">Profile</h2>
                </div>

                <div class="mt-6 flex flex-col lg:flex-row">
                  <div class="flex-grow space-y-6">
                    <div>
                      <label for="about" class="block text-sm font-medium text-gray-700"> About </label>
                      <div class="mt-1">
                        <textarea v-model="form.about" id="about" name="about" rows="3" class="shadow-sm focus:ring-cyan-500 focus:border-cyan-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" />
                      </div>
                      <p class="mt-2 text-sm text-gray-500">Brief description for your profile.</p>
                    </div>
                  </div>

                  <div class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-grow-0 lg:flex-shrink-0">
                    <p class="text-sm font-medium text-gray-700" aria-hidden="true">Photo</p>
                    <div class="mt-1 lg:hidden">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 inline-block rounded-full overflow-hidden h-12 w-12" aria-hidden="true">
                          <img class="rounded-full h-full w-full" :src="form.avatar" alt="" />
                        </div>
                        <div class="ml-5 rounded-md shadow-sm">
                          <div class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-cyan-500">
                            <label for="mobile-user-photo" class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                              <span>Change</span>
                              <span class="sr-only"> user photo</span>
                            </label>
                            <input @change="updateAvatar" accept="image/*" id="mobile-user-photo" name="user-photo" type="file" class="absolute w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="hidden relative rounded-full overflow-hidden lg:block">
                      <img id="avatar" class="relative rounded-full w-40 h-40" :src="$page.props.user.avatar" alt="" />
                      <label for="desktop-user-photo" class="absolute inset-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center text-sm font-medium text-white opacity-0 hover:opacity-100 focus-within:opacity-100">
                        <span>Change</span>
                        <span class="sr-only"> user photo</span>
                        <input @change="updateAvatar"  type="file" accept="image/*" id="desktop-user-photo"  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md" />
                      </label>
                    </div>
                  </div>
                </div>

                <div class="mt-6 grid grid-cols-12 gap-6">
                  <div class="col-span-12 sm:col-span-6">
                    <select-input v-model="form.gender" label="Gender">
                      <option  v-for="gender in ['Male', 'Female']">
                        {{ gender }}
                      </option>
                    </select-input>
                  </div>

                  <div class="col-span-12 sm:col-span-6">
                    <select-input v-model="form.level" label="Experience">
                      <option v-for="experience in experiences" :key="exprience">
                        {{ experience }}
                      </option>
                    </select-input>
                  </div>

                  <div class="col-span-12 sm:col-span-6">
                    <select-input v-model="form.qualification" class="uppercase" label="Qualification">
                      <option v-for="qualification in qualifications" :key="qualification">
                        {{ qualification }}
                      </option>
                    </select-input>
                  </div>

                  <div class="col-span-12 sm:col-span-6">
                    <text-input 
                      v-model="form.nationalId"
                      type="number"
                      label="Your national Id"
                      :errors="form.errors.nationalId"
                    />
                  </div>

                  <div class="col-span-12">
                    <label class="text-gray-900">Availablity</label>
                     <input v-model="form.available" class="w-full mt-1" ref="availability" />
                  </div>

                  <div class="relative col-span-6 mt-2">
                      <file-input 
                        class="w-full" 
                        v-model="form.cv"
                        type="file" 
                        accept="file/*" 
                        label="CV"
                      />
                  </div>

                  <div class="col-span-6 mt-2">
                    <file-input 
                      class="w-full" 
                      type="file"
                      model="optional" 
                      v-model="form.recommendation_letter" 
                      accept="file/*" 
                      label="Recommendation Letter"
                    />
                  </div>

              
                </div>
              </div>

              <div class="p-4">
                <loading-button :loading="form.processing">Update</loading-button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import SelectInput from '@/components/SelectInput'
import TextInput from '@/components/TextInput'
import FileInput from '@/components/FileInput'
import LoadingButton from '@/components/LoadingButton'
import { useForm } from "@inertiajs/inertia-vue3";
import flatpickr from "flatpickr";
import "flatpickr/dist/themes/airbnb.css"

import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Switch,
  SwitchDescription,
  SwitchGroup,
  SwitchLabel,
} from '@headlessui/vue'

import {
  CogIcon,
  KeyIcon,
  UserCircleIcon,
} from '@heroicons/vue/outline'
import { usePage } from "@inertiajs/inertia-vue3";

const qualifications = ['Phd', 'Masters', 'Bachelor']
const experiences = ['1 year', '2 years', '3 years', '4 years', '10 years']
const availability = ref(null)

let props = defineProps({
  profile: Object,
})

const user = usePage().props.value.user;

const form = useForm({
    _method: 'PUT',
    gender: props.profile.gender,
    about: props.profile.about,
    avatar: null,
    qualification: props.profile.qualification,
    level: props.profile.level,
    nationalId: props.profile.nationalId,
    cv: null,
    recommendation_letter: null,
    available: props.profile.availability,
    job: localStorage.getItem("job"),
});

const submit = () => form.post('/profile');

onMounted(() => {
  flatpickr(availability.value, {
    mode: 'range',
    minDate: 'today',
    dateFormat: "Y-m-d",
  })
})

const updateAvatar = (e) => {
  let image = document.getElementById('avatar')
  image.onLoad = () => URL.revokeObject(image.src)
  form.avatar = e.target.files[0]
  image.src = URL.createObjectURL(e.target.files[0])
}

const subNavigation = [
  { name: 'Profile', href: '#', icon: UserCircleIcon, current: true },
]

</script>
