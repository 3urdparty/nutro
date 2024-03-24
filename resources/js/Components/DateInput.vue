<template>
    <div class="mt-1">
        <!-- TODO: Replace with Custom date input -->
        <input
            type="date"
            name="date"
            id="date"
            v-model="date"
            class="block w-full shadow sm:text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md focus:ring-2 ring-blue-300 shadow-sm border focus:border-blue-300 transition placeholder:text-slate-400 focus:placeholder:text-slate-300 resize-none focus:z-10 border-slate-300"
        />
    </div>

    <!-- <InputGroup>
        <div
            class="border border-slate-300 rounded text-input w-1/5 overflow-clip"
        >
            <input class="border-none focus:ring-0" />
        </div>
        <div
            class="border border-slate-300 rounded text-input w-1/5 overflow-clip"
        >
            <input class="border-none focus:ring-0" />
        </div>
        <div
            class="border border-slate-300 rounded text-input w-1/5 overflow-clip"
        >
            <input class="border-none focus:ring-0" />
        </div>
    </InputGroup> -->
</template>
<script setup lang="ts">
import { useVModel } from "@vueuse/core";

interface Props {
    modelValue: string;
    error: boolean;
}
interface Emits {
    (event: "update:modelValue", value: string): boolean;
}
const props = defineProps<Props>();
const emit = defineEmits<Emits>();
const date = useVModel(props, "modelValue", emit);
</script>
