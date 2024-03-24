<script setup lang="ts">
import { EnvelopeIcon } from "@heroicons/vue/24/solid";
import { useVModel } from "@vueuse/core";
import TextInput from "./TextInput.vue";
interface Props {
    modelValue: String;
}
interface Emits {
    (e: "update:modelValue", value: string): void;
}
const props = defineProps<Props>();
const emits = defineEmits<Emits>();
const modelValue = useVModel(props, "modelValue", emits);
</script>
<template>
    <div class="border-none p-0">
        <div class="mt-1 relative rounded-md shadow-sm">
            <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
            >
                <EnvelopeIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </div>
            <TextInput
                v-model="modelValue"
                v-bind="$attrs"
                type="email"
                autocomplete="username"
                input-class="pl-10"
            />
        </div>
    </div>
</template>
