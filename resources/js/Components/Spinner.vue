<template>
    <input
        v-model="value"
        type="number"
        class="rounded-md border-slate-300 shadow-sm placeholder:text-slate-400 text-sm focus:placeholder:text-slate-300 transition"
    />
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
const props = withDefaults(defineProps<Props>(), {
    modelValue: 0,
});
const value = useVModel(props, "modelValue", emits);
</script>
