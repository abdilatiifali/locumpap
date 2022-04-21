<template>
    <label
        :for="id"
        class="block text-sm font-medium text-gray-700"
        v-text="label"
    ></label>
    <select
        :id="id"
        ref="input"
        :name="value"
        :autocomplete="`${id}-name`"
        v-bind="{ ...$attrs }"
        v-model="selected"
        class="text-sm  mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm"
    >
        <slot />
    </select>

    <p class="mt-1 italic text-red-500" v-if="errors">
        {{ errors }}
    </p>
</template>

<script>
import { v4 as uuid } from "uuid";

export default {
    inheritAttrs: false,

    props: {
        modelValue: [String, Number, Boolean],
        errors: String,
        label: String,
        id: {
            type: String,
            default() {
                return `select-input-${uuid()}`;
            },
        },
    },

    emits: ["update:modelValue"],

    data() {
        return {
            selected: this.modelValue,
        };
    },
    watch: {
        selected(selected) {
            this.$emit("update:modelValue", selected);
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },

        select() {
            this.$refs.input.select();
        },
    },
};
</script>
