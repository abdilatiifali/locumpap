<template>
    <main class="flex-1 pb-8">    
      <div class="mt-8">
        <div class="max-w-5xl px-8 sm:px-2 mx-auto">
          <div class="flex justify-between items-center">
            <h2 class="text-2xl leading-6 font-semibold text-gray-900">Payment Details</h2>
            <SwitchGroup as="div" class="flex items-center">
              <Switch v-model="enabled" :class="[enabled ? 'bg-cyan-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500']">
                <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
              </Switch>
              <SwitchLabel as="span" class="ml-3">
                <span class="text-sm font-medium text-gray-900">Annual billing </span>
                <span class="text-sm text-gray-500">(Save 10%)</span>
              </SwitchLabel>
            </SwitchGroup>
          </div>
        </div>

        <div>
          <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <Pricing :price="price" />
          </div>
        </div>
      </div>
    </main>
</template>

<script setup>
import Pricing from "@/components/Pricing"
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { ref, computed } from 'vue'

const enabled = ref(false)

const price = computed(() => {
  return enabled.value ? 30000 : 3000
})

</script>

<script>
  import DashboardLayout from '@/Shared/DashboardLayout'

  export default {
    layout: DashboardLayout,
  }
</script>
