<script setup lang="ts">
import { MinusCircleIcon, PlusCircleIcon } from "@heroicons/vue/24/solid";
interface Props {
    modelValue: number;
}
const props = defineProps<Props>();
interface Emits {
    (e: "update:modelValue", value: number): void;
}

const emits = defineEmits<Emits>();
</script>
<template>
    <div class="flex gap-1 items-center">
        <Button
            type="button"
            @click="
                $emit(
                    'update:modelValue',
                    modelValue - 1 >= 0 ? modelValue - 1 : 0
                )
            "
            class="focus:ring-0 focus:border-0 rounded-full ring-offset-0 focus:ring-offset-2 h-8 w-8"
        >
            <MinusCircleIcon class="w-6 h-6 text-blue-500" />
        </Button>
        <input
            :value="modelValue"
            @input="
                $emit(
                    'update:modelValue',
                    ($event.target as HTMLInputElement).valueAsNumber
                )
            "
            type="number"
            class="border-none w-14 text-blue-600 font-medium focus:border-0 focus:ring-0 text-center h-6 bg-transparent"
        />
        <Button
            type="button"
            class="focus:ring-0 focus:border-0 rounded-full ring-offset-0 focus:ring-offset-1 h-8 w-8"
            @click="$emit('update:modelValue', modelValue + 1)"
        >
            <PlusCircleIcon class="w-full h-full text-blue-500" />
        </Button>
    </div>
</template>
<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
    appearance: textfield;
}
</style>
