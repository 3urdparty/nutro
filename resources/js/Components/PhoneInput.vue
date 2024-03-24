<template>
    <div class="mt-1 relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 flex items-center">
            <label for="country" class="sr-only">Country</label>
            <select
                id="country"
                name="country"
                autocomplete="country"
                class="focus:ring-blue-500 focus:border-blue-500 h-full py-0 pl-3 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-l-md transition"
            >
                <option>+60</option>
                <option>+44</option>
                <option>+50</option>
            </select>
        </div>
        <input
            v-model="number"
            type="text"
            name="phone-number"
            id="phone-number"
            class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-[4.5rem] sm:text-sm border-gray-300 rounded-md transition"
            placeholder="+1 (555) 987-6543"
        />
    </div>
</template>
<script setup lang="ts">
interface Props {
    modelValue: string;
    error: boolean;
}
interface Emits {
    (event: "update:modelValue", value: string): boolean;
}
const props = defineProps<Props>();
const emit = defineEmits<Emits>();
const number = useVModel(props, "modelValue", emit);
import { useVModel } from "@vueuse/core";
</script>
