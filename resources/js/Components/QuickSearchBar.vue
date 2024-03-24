<template>
    <div>
        <div class="mt-1 relative flex items-center">
            <input
                v-model.lazy="search"
                type="text"
                name="search"
                id="search"
                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
            />
            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                <kbd
                    class="inline-flex items-center border border-gray-300 rounded px-2 text-sm font-sans font-medium text-blue-500"
                >
                    ⌘K
                </kbd>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { useVModel } from "@vueuse/core";

interface Props {
    modelValue: string;
}
const props = defineProps<Props>();
interface Emits {
    (e: "update:modelValue", value: string): void;
}
const emits = defineEmits<Emits>();
const search = useVModel(props, "modelValue", emits);
</script>
