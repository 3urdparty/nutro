<template>
    <RadioGroup v-model="selected">
        <RadioGroupLabel class="sr-only"> Pricing plans </RadioGroupLabel>
        <div class="relative bg-white rounded-md -space-y-px">
            <RadioGroupOption
                as="template"
                v-for="(plan, planIdx) in plans"
                :key="plan.name"
                :value="plan.name"
                v-slot="{ checked, active }"
            >
                <div
                    :class="[
                        planIdx === 0 ? 'rounded-tl-md rounded-tr-md' : '',
                        planIdx === plans.length - 1
                            ? 'rounded-bl-md rounded-br-md'
                            : '',
                        checked
                            ? 'bg-blue-50 border-blue-200 z-10'
                            : 'border-gray-200',
                        'relative border p-4 flex flex-col cursor-pointer md:pl-4 md:pr-6 md:grid md:grid-cols-3 focus:outline-none',
                    ]"
                >
                    <div class="flex items-center text-sm">
                        <span
                            :class="[
                                checked
                                    ? 'bg-blue-600 border-transparent'
                                    : 'bg-white border-gray-300',
                                active
                                    ? 'ring-2 ring-offset-2 ring-blue-500'
                                    : '',
                                'h-4 w-4 rounded-full border flex items-center justify-center',
                            ]"
                            aria-hidden="true"
                        >
                            <span class="rounded-full bg-white w-1.5 h-1.5" />
                        </span>
                        <RadioGroupLabel
                            as="span"
                            :class="[
                                checked ? 'text-blue-900' : 'text-gray-900',
                                'ml-3 font-semibold',
                            ]"
                            >{{ plan.name }}</RadioGroupLabel
                        >
                    </div>
                    <RadioGroupDescription
                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center"
                    >
                        <span
                            :class="[
                                checked ? 'text-blue-900' : 'text-gray-900',
                                'font-medium',
                            ]"
                            >+RM{{ plan.fee }}</span
                        >
                        {{ " " }}
                    </RadioGroupDescription>
                    <RadioGroupDescription
                        :class="[
                            checked ? 'text-blue-700' : 'text-gray-500',
                            'ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right',
                        ]"
                        >{{ plan.note }}</RadioGroupDescription
                    >
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>

<script setup lang="ts">
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";
import { useVModel } from "@vueuse/core";

const plans = [
    {
        name: "Normal",
        fee: 2.9,

        note: "Within 40mins-1hr delivery time",
    },
    {
        name: "Quick",
        fee: 4.9,

        note: "Within 20-40mins delivery time",
    },
    {
        name: "Speedy",
        fee: 9.9,

        note: "Within 10-20mins delivery time",
    },
];

interface Props {
    modelValue: Object;
}
const props = defineProps<Props>();
interface Emits {
    (event: "update:modelValue", payload: Object): boolean;
}
const emits = defineEmits<Emits>();
const selected = useVModel(props, "modelValue", emits);
</script>
