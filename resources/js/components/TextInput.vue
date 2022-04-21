<template>
    <div>
        <label
            :for="id"
            class="block text-sm font-medium text-gray-700"
            v-text="label"
        ></label>
        <input
            :id="id"
            :type="type"
            ref="input"
            :value="modelValue"
            :placeholder="label"
            @input="$emit('update:modelValue', $event.target.value)"
            v-bind="{ ...attrs, class: null }"
            class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
        />
    </div>
    <p class="mt-1 italic text-red-500" v-if="errors">
        {{ errors }}
    </p>
</template>

<script>
export default {
    inheritAttrs: false,
};
</script>

<script setup>
import { v4 as uuid } from "uuid";

defineProps({
    modelValue: String,
    errors: String,
    id: {
        type: String,
        default() {
            return `text-input-${uuid()}`;
        },
    },
    label: String,
    type: {
        type: String,
        default: "text",
    },
});

defineEmits(["update:modelValue"]);
</script>
