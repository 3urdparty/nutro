<template>
    <span class="relative z-0 inline-flex shadow-sm rounded-md">
        <span
            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white"
        >
            <label for="select-all" class="sr-only">Select all</label>
            <input
                v-model="checked"
                id="select-all"
                type="checkbox"
                name="select-all"
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            />
        </span>
        <label for="message-type" class="sr-only">Select message type</label>
        <select
            id="message-type"
            name="message-type"
            class="-ml-px block w-full pl-3 pr-9 py-2 rounded-l-none rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
        >
            <option>Select All</option>
            <option>Unsellect All</option>
        </select>
    </span>
</template>
<script setup lang="ts">
import { useVModel } from "@vueuse/core";
interface Props {
    modelValue?: Boolean;
}
const props = defineProps<Props>();
interface Emits {
    (e: "update:modelValue", value: boolean): void;
}
const emits = defineEmits<Emits>();
const checked = useVModel(props, "modelValue", emits);
</script>
