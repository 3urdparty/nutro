<template>
    <div>
        <div class="-space-y-[5px]">
            <PasswordInput
                v-bind="$attrs"
                v-model="value"
                autocomplete="new-password"
                class="rounded-t rounded-b-none focus-within:z-20"
            />
            <!-- TODO: Remove icon space from input -->
            <!-- TODO: Make the password input hide/show button apply the same effect  to the confirm input -->
            <!-- TODO: Fix the confirm error state to only trigger when the input is dirty -->
            <PasswordInput
                v-bind="$attrs"
                v-model="confirm"
                autocomplete="new-password"
                class="rounded-b rounded-t-none"
                :error="value !== confirm && confirm.length > 0"
                ><template #icon>
                    <CheckCircleIcon />
                </template>
            </PasswordInput>
        </div>

        <div class="w-full flex items-center gap-2">
            <div class="w-2/3 h-1.5 flex gap-1 mt-1">
                <div
                    v-for="(condition, index) in conditions"
                    :class="[
                        strength >= index + 1
                            ? condition.style
                            : 'bg-slate-400/30',
                    ]"
                    class="w-1/3 h-full rounded"
                />
            </div>
            <span class="text-sm text-slate-400 mt-1">
                {{
                    strength === 1
                        ? "Weak"
                        : strength === 2
                        ? "Moderate"
                        : strength === 3
                        ? "Good"
                        : "Strong"
                }}
            </span>
        </div>

        <ul class="list-square list-inside text-xs">
            <!-- TODO: Replace the sqare list with checkboxes -->
            <li v-for="condition in conditions" :key="condition.label">
                <span
                    :class="[
                        condition.satisfied()
                            ? 'text-green-600/60'
                            : 'text-red-400/80',
                    ]"
                    >{{ condition.label }}</span
                >
            </li>
        </ul>
    </div>
</template>
<script setup lang="ts">
import PasswordInput from "@/Components/PasswordInput.vue";
import { CheckCircleIcon } from "@heroicons/vue/24/solid";
import { useVModel } from "@vueuse/core";
import { computed } from "vue";

interface Props {
    modelValue: String;
    confirm: String;
}

const conditions = [
    {
        label: "At least 8 characters",
        satisfied: () => props.modelValue.length > 8,
        style: "bg-red-400/90",
    },
    {
        label: "At least one lowercase letter and one uppercase letter",
        satisfied: () =>
            props.modelValue.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/),
        style: "bg-orange-400/70",
    },
    {
        label: "At least one number and one special character",
        satisfied: () =>
            props.modelValue.match(/([a-zA-Z])/) &&
            props.modelValue.match(/([0-9])/) &&
            props.modelValue.match(/([!,%,&,@,#,$,^,*,?,_,~])/),
        style: "bg-green-400/70",
    },
];
interface Emits {
    (e: "update:modelValue", value: string): void;
    (e: "update:confirm", value: string): void;
}

const strength = computed(() => {
    var strength = 0;
    conditions.forEach((condition) => {
        if (condition.satisfied()) {
            strength++;
        }
    });
    return strength;
});
const props = defineProps<Props>();
const emits = defineEmits<Emits>();
const value = useVModel(props, "modelValue", emits);
const confirm = useVModel(props, "confirm", emits);
</script>
