<template>
    <span
        class="inline-flex items-center w-fit px-2.5 py-0.5 rounded-full text-xs font-medium h-fit"
        :class="classes"
    >
        <slot />
    </span>
</template>
<script setup lang="ts">
import { computed } from "vue";

export type Severity = "none" | "error" | "warning" | "success" | "info";
interface Props {
    severity: Severity;
}
const props = withDefaults(defineProps<Props>(), {
    severity: "none",
});
const classes = computed(() => {
    return {
        "bg-gray-100 text-gray-800": props.severity === "none",
        "bg-red-100 text-red-800": props.severity === "error",
        "bg-yellow-100 text-yellow-800": props.severity === "warning",
        "bg-green-100 text-green-800": props.severity === "success",
        "bg-blue-100 text-blue-800": props.severity === "info",
    };
});
</script>
