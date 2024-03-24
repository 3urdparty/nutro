<template>
    <Button
        class="h-7 w-7 rounded-full top-0 flex items-center justify-center p-0.5"
    >
        <HeartIcon
            class="stroke hover:stroke-2 stroke-red-400"
            :class="[liked ? 'fill-red-300 stroke-red-100' : '']"
        />
    </Button>
</template>
<script setup lang="ts">
import { HeartIcon } from "@heroicons/vue/24/outline";

interface Props {
    liked: boolean;
}

defineProps<Props>();
</script>
