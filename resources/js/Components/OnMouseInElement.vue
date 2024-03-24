<template>
    <div ref="el">
        <slot v-bind="{ ...mouseInElement }" />
    </div>
</template>
<script setup lang="ts">
import { useMouseInElement } from "@vueuse/core";
import { ref, watch } from "vue";
const el = ref<HTMLElement | null>(null);
const mouseInElement = useMouseInElement(el);

interface Emits {
    (event: "mouseOn", inElement: boolean, x: number, y: number): void;
}
const emits = defineEmits<Emits>();

watch(
    [
        mouseInElement.isOutside,
        mouseInElement.elementX,
        mouseInElement.elementY,
        mouseInElement.elementWidth,
        mouseInElement.elementHeight,
    ],
    (value, newVal) => {
        emits(
            "mouseOn",
            !value[0],
            (value[1] / value[3]) * 100,
            (value[2] / value[4]) * 100
        );
    }
);
</script>
