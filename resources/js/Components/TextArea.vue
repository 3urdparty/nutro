<template>
    <textarea
        ref="textAreaEl"
        rows="4"
        name="comment"
        v-model="input"
        id="comment"
        v-bind="$attrs"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md focus:ring-2 ring-blue-300 shadow-sm border focus:border-blue-300 transition placeholder:text-slate-400 focus:placeholder:text-slate-300 text-sm resize-none scrollbar-none min-h-[5rem]"
    />
</template>

<script setup lang="ts">
import { useTextareaAutosize, useVModel } from "@vueuse/core";
import { ref } from "vue";

interface Props {
    modelValue: string;
}
interface Emits {
    (event: "update:modelValue", ...args: any[]): boolean;
}
const props = defineProps<Props>();
const emits = defineEmits<Emits>();
const text = useVModel(props, "modelValue", emits);
const textAreaEl = ref<HTMLTextAreaElement>(null);
const { input } = useTextareaAutosize({ element: textAreaEl, input: text });
</script>
