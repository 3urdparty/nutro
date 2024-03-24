<template>
    <div class="relative overflow-clip h-16 min-w-[14rem]">
        <div
            class="overflow-clip flex items-center -space-x-3 absolute top-0 left-0 pb-5"
        >
            <div
                v-for="(item, idx) in items.slice(0, 10)"
                class="h-14 w-14 rounded-full border dow-sm bg-white p-1 hover:border-blue-400 transition group relative"
            >
                <img
                    :key="item.id"
                    class="h-full w-full rounded-full group-hover:opacity-75 group-hover:scale-105 transition object-contain"
                    :src="item.image_url"
                    :alt="item.name"
                />
                <span
                    class="absolute -bottom-1 font-semibold right-2 text-xs z-10 text-blue-500"
                    >x{{ item.listing.quantity }}</span
                >
            </div>
        </div>
        <div
            class="from-transparent pointer-events bg-gradient-to-r to-white w-20 h-full absolute right-0 z-20 top-0 group-hover:to-slate-50"
        />
    </div>
</template>
<script setup lang="ts">
interface Props {
    items: App.Models.FoodItem[];
    count: number;
}
const props = withDefaults(defineProps<Props>(), {
    count: 3,
});
</script>
