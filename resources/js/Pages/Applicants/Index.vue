<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="min-h-screen mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:max-w-7xl">
    <applicants :filters="filters" :professions="professions" :applicants="applicants" />
  </div>
</template>

<script setup>
import Applicants from '@/components/Applicants'
let props = defineProps({
  applicants: Array,
  professions: Array,
  filters: Object,
})

</script>