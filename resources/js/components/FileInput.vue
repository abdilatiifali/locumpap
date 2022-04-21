<template>
    <div>
        <label v-if="label" class="form-label">{{ label }}:</label>
        <div class="form-input p-0">
            <input
                ref="file"
                type="file"
                :accept="accept"
                class="hidden"
                @change="change"
            />
            <div v-if="!modelValue" class="py-2">
                <button
                    type="button"
                    class="w-full rounded-lg bg-cyan-500 px-4 py-2 text-xs font-medium text-white hover:bg-cyan-700 md:w-1/2"
                    @click="browse"
                >
                    Browse
                </button>
            </div>
            <div v-else class="flex items-center justify-between p-2">
                <div class="flex-1 pr-1">
                    {{ modelValue.name }}
                    <span class="text-xs text-gray-500"
                        >({{ filesize(modelValue.size) }})</span
                    >
                </div>
                <button
                    type="button"
                    class="rounded-sm px-4 py-1 text-xs font-medium text-gray-900"
                    @click="remove"
                >
                    Remove
                </button>
            </div>
        </div>
        <p v-if="errors" class="italic text-red-500">{{ errors }}</p>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: File,
        label: String,
        accept: String,
        errors: String,
    },
    emits: ["update:modelValue"],
    watch: {
        modelValue(value) {
            if (!value) {
                this.$refs.file.value = "";
            }
        },
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024));
            return (
                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                " " +
                ["B", "kB", "MB", "GB", "TB"][i]
            );
        },
        browse() {
            this.$refs.file.click();
        },
        change(e) {
            this.$emit("update:modelValue", e.target.files[0]);
        },
        remove() {
            this.$emit("update:modelValue", null);
        },
    },
};
</script>
