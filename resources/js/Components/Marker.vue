<template>
    <div class="group absolute" :style="{ left: `${x}px`, top: `${y}px` }">
        <div
            class="bg-blue-500 group-hover:bg-blue-400 text-white px-2 rounded-md font-medium py-1 shadow-sm select-none transition cursor-pointer w-fit"
        >
            <slot />
        </div>

        <div class="absolute z-10 -mt-1 w-full flex justify-center">
            <svg
                class="w-3 text-blue-500 rounded group-hover:text-blue-400 transition cursor-pointer"
                fill="currentColor"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 490 490"
                xml:space="preserve"
            >
                <polygon points="245,456.701 490,33.299 0,33.299 " />
            </svg>
        </div>
    </div>
</template>
<script setup lang="ts">
interface Props {
    x?: number;
    y?: number;
}
const props = withDefaults(defineProps<Props>(), {
    x: 0,
    y: 0,
});
</script>
