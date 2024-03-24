<template>
    <div class="md:flex md:items-center md:justify-between pb-5 md:pb-0">
        <div class="flex-1 min-w-0">
            <slot name="header">
                <input
                    v-if="isDefined(modelValue)"
                    v-model="text"
                    :placeholder="placeholder ?? 'Header'"
                    class="text-2xl pl-0 font-bold leading-7 text-slate-600 sm:text-2xl sm:truncate border-0 bg-slate-50 focus:ring-0 placeholder:text-slate-300 placeholder:focus:text-slate-400 transition"
                />
                <h2
                    v-else
                    class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
                >
                    {{ heading }}
                </h2>
            </slot>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <slot name="actions" />
        </div>
    </div>
</template>
<script setup lang="ts">
import { isDefined, useVModel } from "@vueuse/core";

interface Props {
    heading?: string;
    modelValue?: string;
    placeholder?: string;
}
interface Emits {
    (event: "update:modelValue", value: string): void;
}

const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const text = useVModel(props, "modelValue", emits);
</script>
