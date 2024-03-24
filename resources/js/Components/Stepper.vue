<script setup lang="ts">
import { useVModel } from "@vueuse/core";

interface Props {
    modelValue: number;
    total: number;
}

interface Emits {
    (event: "update:modelValue", value: number): boolean;
}

const emits = defineEmits<Emits>();
const props = defineProps<Props>();

const currentStep = useVModel(props, "modelValue", emits);
</script>
<template>
    <div class="h-3 flex gap-1">
        <button
            class="rounded-full transition-all ease-in-out duration-200 w-10 transform origin-center"
            v-for="step in total"
            @click="currentStep = step"
            :class="[
                currentStep == step - 1
                    ? 'w-14 bg-white h-full scale-x-3 '
                    : 'aspect-square bg-blue-50/30 h-full w-3 transition hover:bg-brand-400',
            ]"
        ></button>
    </div>
</template>
