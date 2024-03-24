<template>
    <div class="rounded-l-full">
        <button
            class="bg-blue-500 px-4 py-2 pr-10 rounded-l-full relative group w-10 hover:w-16 transform transition-width active:bg-blue-300"
        >
            <ShoppingBagIcon class="text-blue-50 w-6 h-6" />
            <span
                class="absolute -left-1 -bottom-1 bg-blue-600 w-6 h-5 text-xs rounded-full font-sora flex items-center justify-center text-white/80 font-medium"
                v-if="count"
            >
                {{ count }}
            </span>
        </button>
    </div>
</template>
<script setup lang="ts">
import { ShoppingBagIcon } from "@heroicons/vue/24/solid";
interface Props {
    count: number;
}
const props = withDefaults(defineProps<Props>(), {
    count: 0,
});
</script>
