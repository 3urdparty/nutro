<script setup lang="ts">
import { ArrowRightIcon } from "@heroicons/vue/24/solid";
interface Emits {
    (e: "click", event: MouseEvent): void;
}
</script>
<template>
    <button
        class="w-12 h-12 rounded-full bg-brand-500 flex justify-center hover:opacity-80 active:opacity-60 transition"
    >
        <ArrowRightIcon class="w-7 text-white/90" />
    </button>
</template>
