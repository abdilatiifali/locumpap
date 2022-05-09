<template>
    <select
        class="w-full rounded-md border py-2 px-8 focus:border-cyan-500 focus:outline-none focus:ring-cyan-500"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option value="all">
            <span class="hidden lg:block">{{ modelName }}</span> 
        </option>
        <option :value="option.slug" v-for="option in options" :key="option.id">
            {{ option.name }}
        </option>
    </select>
</template>

<script setup>
const props = defineProps({
    modelValue: String,
    options: Array,
    modelName: String,
});

defineEmits(["update:modelvalue"]);
</script>
