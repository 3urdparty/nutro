<template>
    <div class="pt-px">
        <div class="relative rounded-md shadow-sm">
            <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
            >
                <span class="text-gray-500 sm:text-sm font-semibold"> RM </span>
            </div>
            <input
                v-model="value"
                type="text"
                name="price"
                id="price"
                class="block w-full pl-10 pr-12 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md focus:ring-2 ring-blue-300 shadow-sm border focus:border-blue-300 transition placeholder:text-slate-400 focus:placeholder:text-slate-300"
                placeholder="0.00"
            />
            <div class="absolute inset-y-0 right-0 flex items-center">
                <label for="currency" class="sr-only">Currency</label>
                <select
                    id="currency"
                    name="currency"
                    class="focus:ring-blue-500 focus:border-blue-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                >
                    <option>MYR</option>
                    <option>USD</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useVModel } from "@vueuse/core";

interface Props {
    modelValue: number;
}

interface Emits {
    (event: "update:modelValue", value: number): void;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();

const value = useVModel(props, "modelValue", emits);
</script>
