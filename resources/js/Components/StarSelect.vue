<template>
    <!-- TODO: Fix this component -->
    <div class="flex items-center">
        <div class="flex items-center">
            <Star
                v-for="(r, idx) in total"
                :key="idx"
                :model-value="rating - idx"
                @update:model-value="(value) => (rating = value + idx)"
            />
        </div>
    </div>
</template>
<script setup lang="ts">
import { useVModel } from "@vueuse/core";
import { computed } from "vue";
import Star from "./Star.vue";

interface Props {
    total?: number;
    modelValue: number;
    readonly?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    total: 5,
    modelValue: 0,
    readonly: true,
});
interface Emits {
    (event: "update:modelValue", value: number): boolean;
}
const roundDown = (num: number) => Math.floor(num);
const roundUp = (num: number) => Math.ceil(num);
const partialStar = computed(
    () => props.modelValue - roundDown(props.modelValue)
);
const emit = defineEmits<Emits>();
const rating = useVModel(props, "modelValue", emit);
</script>
