<script setup lang="ts">
import { EyeIcon, EyeSlashIcon, LockClosedIcon } from "@heroicons/vue/24/solid";
import { useVModel } from "@vueuse/core";
import { ref } from "vue";
import TextInput from "./TextInput.vue";
interface Props {
    modelValue: String;
    error?: boolean;
}
interface Emits {
    (e: "update:modelValue", value: string): void;
}
const props = defineProps<Props>();
const emits = defineEmits<Emits>();
const modelValue = useVModel(props, "modelValue", emits);
const showPassword = ref(false);
</script>
<template>
    <div class="relative p-0 border-none rounded-md shadow-sm">
        <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
        >
            <slot name="icon">
                <!-- TODO:Abstract this into TextInput and make it a slot -->
                <LockClosedIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </slot>
        </div>
        <TextInput
            v-model="modelValue"
            v-bind="$attrs"
            :type="showPassword ? 'text' : 'password'"
            autocomplete="current-password"
            :error="error"
            class="m-0"
            input-class="pl-10"
            id="password"
        />
        <button
            type="button"
            class="absolute inset-y-0 right-0 pr-3 flex items-center"
            @click="showPassword = !showPassword"
        >
            <EyeIcon
                v-if="showPassword"
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
            />
            <EyeSlashIcon
                v-else
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
            />
        </button>
    </div>
</template>
