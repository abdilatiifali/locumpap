<template>
  <nav 
      class="bg-white px-4 py-4 flex items-center justify-between border-t border-gray-200 sm:px-6" 
      aria-label="Pagination"
  >
      <div class="hidden sm:block">
        <p class="text-sm text-gray-700">
          Showing
          {{ ' ' }}
          <span class="font-medium">{{ meta.current_page }}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">{{ meta.per_page }}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">{{ meta.total }}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div class="flex-1 flex justify-between sm:justify-end">
        <Link :href="links.prev"
          :disabled="links.prev == null"
          :class="{'opacity-25 cursor-not-allowed': links.prev == null}"
          class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
      > 
          Previous 
      </Link>
        <Link 
              :disabled="links.next == null"
              :class="{'opacity-25 cursor-not-allowed': links.next == null}"
              :href="links.next" 
              class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
          > 
              Next 
          </Link>
      </div>
  </nav>
</template>

<script setup>
defineProps({
  links: Object,
  meta: Object,
})
</script>
