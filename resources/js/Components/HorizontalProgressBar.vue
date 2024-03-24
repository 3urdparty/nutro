<template>
    <div class="py-1 pb-3 pl-1" :class="{ 'pt-6': $slots.default }">
        <div class="bg-slate-200 rounded-full h-2">
            <div
                class="relative t h-full"
                :style="{ width: completedBarWidth }"
            >
                <!-- Marker -->
                <div class="absolute top-0 -mt-10 left-0">
                    <div class="relative">
                        <slot />
                    </div>
                </div>
                <div
                    class="w-full hover:bg-blue-400 h-full bg-blue-500 rounded-full absolute transform left-0 transition"
                />
                <div
                    class="absolute left-0 top-0 mt-3 -ml-3 text-slate-500 font-medium text-sm"
                    v-if="width > 20"
                >
                    {{ start }}
                </div>

                <div
                    class="w-3 h-3 cursor-pointer hover:bg-slate-600 -mt-0.5 -ml-0.5 bg-slate-500 border-2 border-slate-600 rounded-full absolute transform top-0 left-0"
                />
                <div
                    class="w-3 h-3 cursor-pointer hover:bg-blue-200 -mt-0.5 -mr-0.5 bg-blue-100 rounded-full absolute transform border-2 border-slate-500 right-0"
                />
                <div
                    class="absolute right-0 top-0 mt-3 -mr-4 text-slate-500 font-medium text-sm"
                >
                    {{ end }}
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="tsx">
import { computed } from "vue";

export type Orientation = "horizontal" | "vertical";
interface Props {
    orientation?: Orientation;
    value?: number;
    total?: number;
    start?: string;
    end?: string;
    width: number;
}

const props = withDefaults(defineProps<Props>(), {
    orientation: "horizontal",
    value: 20,
    total: 100,
    width: 20,
});

const completedBarWidth = computed(() => `${props.width}%`);
</script>
