<template>
    <div class="flex items-start">
        <div
            :class="{
                'flex-col': props.orientation === 'vertical',
                'flex-row': props.orientation === 'horizontal',
            }"
            class="mt-2 flex h-full items-center"
        >
            <div class="w-3 h-3 bg-blue-500 rounded-full" />

            <div
                class="bg-slate-300 rounded-md overflow-clip"
                :class="{
                    'w-1 h-32': props.orientation === 'vertical',
                    'w-32 h-1': props.orientation === 'horizontal',
                }"
            >
                <div
                    class="w-full bg-blue-500"
                    :style="{
                        height: `${
                            props.orientation === 'vertical' ? completion : 100
                        }%`,
                        width: `${
                            props.orientation === 'horizontal'
                                ? completion
                                : 100
                        }%`,
                    }"
                ></div>
            </div>
            <div class="w-3 h-3 bg-blue-500 rounded-full" />
        </div>
    </div>
</template>
<script setup lang="ts">
import { computed } from "vue";

export type Orientation = "horizontal" | "vertical";
interface Props {
    orientation?: Orientation;
    value?: number;
    total?: number;
}

const props = withDefaults(defineProps<Props>(), {
    orientation: "horizontal",
    value: 20,
    total: 100,
});
const completion = computed(() => (props.value / props.total) * 100);
</script>
