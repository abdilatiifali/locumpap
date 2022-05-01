<template>
    <main class="flex-1 pb-8">    
      <div class="mt-8">
        <div class="max-w-5xl px-8 sm:px-2 mx-auto">
          <h2 class="text-2xl leading-6 font-semibold text-gray-900">Payment Details</h2>
        </div>

        <div>
          <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <Pricing />
          </div>
        </div>
      </div>
    </main>
</template>

<script setup>
import Pricing from "@/components/Pricing"

</script>

<script>
  import DashboardLayout from '@/Shared/DashboardLayout'

  export default {
    layout: DashboardLayout,
  }
</script>
