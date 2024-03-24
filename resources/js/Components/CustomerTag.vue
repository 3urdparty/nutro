<template>
    <div>
        <div class="flex gap-2 items-center">
            <div
                class="flex bg-white gap-2 items-center rounded-full border p-1 w-fit px-1 pr-2 shadow-sm py-0.5 hover:bg-slate-50 cursor-pointer hover:border-slate-400 transition select-none border-slate-400"
            >
                <Avatar class="w-5" />
                <p class="text-xs text-slate-400">{{ name }}</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Avatar from "./Avatar.vue";
interface Props {
    name: string;
    image: string;
}
const props = defineProps<Props>();
</script>
