<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">Location</label>
        <input
            @place-changed="change"
            ref="location"
            placeholder="Type Here"
            class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
        />
    </div>
    <p class="mt-1 italic text-red-500" v-if="errors">
        {{ errors }}
    </p>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const location = ref(null)
const emit = defineEmits(['place-changed'])
defineProps({
    errors: String,
})

onMounted(() => {
    var autocomplete = new google.maps.places.Autocomplete(location.value);

    autocomplete.setComponentRestrictions({
        country: ['ke'],
    })
    autocomplete.setFields([ "name"]);
    // autocomplete.setTypes(['hospital', 'pharmacy', 'dentist', 'doctor', 'physiotherapist']);

    autocomplete.addListener('place_changed', function () {
        emit('place-changed', autocomplete.getPlace().name)
    })
})

</script>
