<template>
	<div  class="min-h-full min-h-sceen">
		<TransitionRoot as="template" :show="sidebarOpen">
	      <Dialog 
	      	as="div" 
	      	class="fixed inset-0 flex z-40 lg:hidden" 
	      	@close="sidebarOpen = false"
	      	>
		        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
		          <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
		        </TransitionChild>
		        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
		          <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-cyan-700">
		            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
		              <div class="absolute top-0 right-0 -mr-12 pt-2">
		                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
		                  <span class="sr-only">Close sidebar</span>
		                  <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
		                </button>
		              </div>
		            </TransitionChild>
		            <div class="flex-shrink-0 flex items-center px-4">
		              <img class="h-8 w-auto" :src="$page.props.logoUrl" alt="Locum Pap logo" />
		            </div>
		            <nav class="mt-5 flex-shrink-0 h-full divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">
		              <div class="px-2 space-y-1">
		                <Link @click="sidebarOpen = false;" v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']" :aria-current="item.current ? 'page' : undefined">
		                  <component :is="item.icon" class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" aria-hidden="true" />
		                  {{ item.name }}
		                </Link>
		              </div>
		              <div class="mt-6 pt-6">
		                <div class="px-2 space-y-1">
		                  <a v-for="item in secondaryNavigation" :key="item.name" :href="item.href" class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">
		                    <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
		                    {{ item.name }}
		                  </a>
		                </div>
		              </div>
		            </nav>
		          </div>
		        </TransitionChild>
		        <div class="flex-shrink-0 w-14" aria-hidden="true">
		          <!-- Dummy element to force sidebar to shrink to fit close icon -->
		        </div>
      		</Dialog>
    	</TransitionRoot>

    	<!-- Static sidebar for desktop -->
	    <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
	      <!-- Sidebar component, swap this element with another sidebar if you like -->
	      <div class="flex flex-col flex-grow bg-cyan-700 pt-5 pb-4 overflow-y-auto">
	        <div class="flex items-center flex-shrink-0 px-4">
	          <h3 class="text-white">
	          	<Link href="/">Locum Page</Link>
	          </h3>
	        </div>
	        <nav class="mt-5 flex-1 flex flex-col divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">
	          <div class="px-2 space-y-1">
	            <Link v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md']" :aria-current="item.current ? 'page' : undefined">
	              <component :is="item.icon" class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" aria-hidden="true" />
	              {{ item.name }}
	            </Link>
	          </div>
	          <div class="mt-6 pt-6">
	            <div class="px-2 space-y-1">
	              <a v-for="item in secondaryNavigation" :key="item.name" :href="item.href" class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">
	                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
	                {{ item.name }}
	              </a>
	            </div>
	          </div>
	        </nav>
	      </div>
	    </div>

	    <div class="lg:pl-64 flex flex-col flex-1">
	      <div class="relative py-4 px-2 z-10 flex-shrink-0 flex bg-white border-b border-gray-200 lg:border-none">
	        <button type="button" class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden" @click="sidebarOpen = true">
	          <span class="sr-only">Open sidebar</span>
	          <MenuAlt1Icon class="h-6 w-6" aria-hidden="true" />
	        </button>
	        
	      </div>

	      <slot />

	   </div>

	</div>

</template>

<script setup>
import { ref } from 'vue'
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  BellIcon,
  ClockIcon,
  CogIcon,
  CreditCardIcon,
  DocumentReportIcon,
  HomeIcon,
  MenuAlt1Icon,
  QuestionMarkCircleIcon,
  ScaleIcon,
  ShieldCheckIcon,
  UserGroupIcon,
  XIcon,
} from '@heroicons/vue/outline'
import {
  CashIcon,
  CheckCircleIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  OfficeBuildingIcon,
  SearchIcon,
} from '@heroicons/vue/solid'



const navigation = [
  { name: 'Home', href: '/', icon: HomeIcon, current: true },
  { name: 'Jobs You Posted', href: '/dashboard', icon: ClockIcon, current: false },
  { name: 'Healthcare professionals', href: '/dashboard/healthcare-professionals', icon: ScaleIcon, current: false },
  { name: 'Payments', href: '/dashboard/payment', icon: ScaleIcon, current: false },

  // { name: 'Cards', href: '#', icon: CreditCardIcon, current: false },
  // { name: 'Recipients', href: '#', icon: UserGroupIcon, current: false },
  // { name: 'Reports', href: '#', icon: DocumentReportIcon, current: false },
]
const secondaryNavigation = [
  { name: 'Settings', href: '#', icon: CogIcon },
  { name: 'Help', href: '#', icon: QuestionMarkCircleIcon },
  { name: 'Privacy', href: '#', icon: ShieldCheckIcon },
]


const sidebarOpen = ref(false)

</script>
