<template>
    <div class="">
        <div
            class="flex text-black border border-blue-500 rounded-md overflow-clip h-10 divide-x"
            ref="container"
        >
            <button
                v-for="item in items"
                @click="selected = item"
                class="h-full transition text-xs capitalize whitespace-nowrap w-full"
                :class="[
                    selected == item
                        ? 'bg-blue-400 hover:bg-blue-500 text-white'
                        : 'text-blue-500 hover:bg-slate-100',
                ]"
            >
                <slot name="option" :item="item">
                    {{ item }}
                </slot>
            </button>
        </div>
    </div>
</template>
<script setup lang="ts">
import { useVModel } from "@vueuse/core";
import { computed, ref } from "vue";

export type Option = {
    name: string;
    value: string | number;
    icon: string | Object;
};
interface Props {
    items: Array<Option>;
    modelValue: Option | string;
}
interface Emits {
    (e: "update:modelValue", value: Option): void;
}
const emits = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
});
const selected = useVModel(props, "modelValue", emits);
const container = ref<HTMLInputElement>();

const containerWidth = computed(() => container.value?.clientWidth);
const width = computed(
    () => `${containerWidth.value / (props.items.length || 1)}px`
);
</script>
