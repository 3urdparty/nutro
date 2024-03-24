import { ArrowRightIcon } from '@heroicons/vue/24/solid';
<template>
    <button
        class="bg-blue-700 h-10 flex items-center justify-center px-2 group w-full"
    >
        <p
            class="text-sm font-medium text-white px-4 sm:px-6 lg:px-8 group-hover:text-blue-200 transition"
        >
            <slot />
        </p>

        <ArrowRightIcon
            class="w-4 text-white group-hover:translate-x-2 transition ease-in-out group-hover:text-blue-200"
        />
    </button>
</template>
<script setup lang="ts">
import { ArrowRightIcon } from "@heroicons/vue/24/solid";
</script>
