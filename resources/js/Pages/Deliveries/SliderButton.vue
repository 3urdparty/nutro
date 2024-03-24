<template>
    <div
        class="bg-slate-700 rounded-full w-full border shadow-inner p-2 relative"
        ref="containerEl"
    >
        <div class="w-full relative h-full">
            <div
                ref="handleEl"
                class="bg-white hover:bg-slate-50 active:bg-slate-300 transition rounded-full cursor-grab focus:cursor-grabbing absolute h-full aspect-square z-10"
                :style="{ left: Math.max(x - 20, 0) + 'px' }"
            />
        </div>
        <div
            class="absolute left-0 top-0 w-full h-full flex justify-center items-center text-white font-medium text-xl text-white/50 select-none"
        ></div>
    </div>
</template>

<script setup lang="ts">
import { useDraggable } from "@vueuse/core";
import { ref } from "vue";

interface Props {
    placeholder: string;
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: "Slide to complete",
});
const handleEl = ref<HTMLElement | null>(null);
const containerEl = ref<HTMLElement | null>(null);

const { x, y, style } = useDraggable(handleEl, {
    onMove(position, event) {
        console.log(containerEl.value.clientWidth);
    },
    onEnd(position, event) {
        if (position.x > 400) {
            console.log("Completed");
        }
    },
    containerElement: containerEl,
});
</script>
