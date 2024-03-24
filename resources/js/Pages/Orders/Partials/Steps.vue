<script setup lang="ts" generic="S extends Step">
import { CheckIcon } from "@heroicons/vue/24/solid";
import { useStepper, useVModel } from "@vueuse/core";
export type Step = {
    name: string;
    isComplete?: () => boolean;
    isValid?: () => boolean;
};
interface Props {
    steps: {
        [key: string]: Step;
    };
}
const props = withDefaults(defineProps<Props>(), {
    steps: () => {},
});
interface Emits {
    (e: "update:steps", steps: Array<Step>): void;
    (e: "change", key: string, index: number): void;
}
const emits = defineEmits<Emits>();
const stepValues = useVModel(props, "steps", emits);
const {
    steps,
    stepNames,
    index,
    current,
    next,
    previous,
    isFirst,
    isLast,
    goTo,
    goToNext,
    goToPrevious,
    goBackTo,
    isNext,
    isPrevious,
    isCurrent,
    isBefore,
    isAfter,
} = useStepper(stepValues);
import { watch } from "vue";

defineExpose({
    index,
    isLast,
    goToNext,
    goToPrevious,
});

const goToStep = (stepKey: string) => {
    if (
        (isNext(stepKey) && (current.value as Step).isValid()) ||
        isAfter(stepKey)
    )
        goTo(stepKey);
};
</script>

<template>
    <nav aria-label="Progress">
        <ol
            role="list"
            class="border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0 border"
        >
            <li
                v-for="(step, stepKey) in steps"
                :key="step.name"
                class="relative md:flex-1 md:flex"
            >
                <button
                    @click="goToStep(stepKey as string)"
                    v-if="step.isComplete()"
                    class="group flex items-center w-full"
                >
                    <span
                        class="px-6 py-4 flex items-center text-sm font-medium"
                    >
                        <span
                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full group-hover:bg-blue-800"
                        >
                            <CheckIcon
                                class="w-6 h-6 text-white"
                                aria-hidden="true"
                            />
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-900">{{
                            step.name
                        }}</span>
                    </span>
                </button>
                <button
                    @click="goToStep(stepKey as string)"
                    v-else-if="isCurrent(stepKey)"
                    class="px-6 py-4 flex items-center text-sm font-medium"
                    aria-current="step"
                >
                    <span
                        class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-blue-600 rounded-full"
                    >
                        <span class="text-blue-600">{{ stepKey }}</span>
                    </span>
                    <span class="ml-4 text-sm font-medium text-blue-600">{{
                        step.name
                    }}</span>
                </button>
                <button
                    @click="goToStep(stepKey as string)"
                    v-else
                    class="group flex items-center"
                >
                    <span
                        class="px-6 py-4 flex items-center text-sm font-medium"
                    >
                        <span
                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400"
                        >
                            <span
                                class="text-gray-500 group-hover:text-gray-900"
                                >{{ stepKey }}</span
                            >
                        </span>
                        <span
                            class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900"
                            >{{ step.name }}</span
                        >
                    </span>
                </button>
                <template v-if="stepIdx !== steps.length - 1">
                    <!-- Arrow separator for lg screens and up -->
                    <div
                        class="hidden md:block absolute top-0 right-0 h-full w-5"
                        aria-hidden="true"
                    >
                        <svg
                            class="h-full w-full text-gray-300"
                            viewBox="0 0 22 80"
                            fill="none"
                            preserveAspectRatio="none"
                        >
                            <path
                                d="M0 -2L20 40L0 82"
                                vector-effect="non-scaling-stroke"
                                stroke="currentcolor"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                </template>
            </li>
        </ol>
    </nav>
</template>
