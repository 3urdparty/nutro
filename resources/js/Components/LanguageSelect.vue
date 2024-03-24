<script setup lang="ts">
import { useLanguage } from "@/Composables/language";
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";
import Button from "./Button.vue";
const show = ref(false);
const items = [
    {
        name: "English",
        short: "en",
        flag: "/images/flags/uk.png",
    },
    {
        name: "Malay",
        short: "ms",
        flag: "/images/flags/malaysia.png",
    },
];
const { language, change } = useLanguage();
</script>
<template>
    <div class="relative">
        <Button
            @click="show = !show"
            class="p-1 px-1.5 bg-white/30 border border-white rounded-md text-white text-left text-sm gap-1.5 items-center font-bold flex h-full"
        >
            <div class="flex gap-2">
                <img
                    src="/images/flags/malaysia.png"
                    class="w-8 shadow-md rounded-sm"
                />
                <ChevronDownIcon class="w-4 text-white" aria-hidden="true" />
            </div>
        </Button>
        <transition name="slide">
            <div
                v-show="show"
                class="absolute w-full bg-white p-1 rounded text-sm border divide-y py-1 mt-0.5"
            >
                <ul class="space-y-1">
                    <li v-for="item in items">
                        <button
                            @click="
                                change(item.short);
                                show = false;
                            "
                            :class="{
                                'bg-blue-200': item.short === language,
                            }"
                            class="hover:bg-blue-200 w-full text-start rounded px-2 py-1 flex items-center gap-1 uppercase text-sm text-slate-500"
                        >
                            <img :src="item.flag" class="w-5 h-3 rounded-sm" />
                            {{ item.short }}
                        </button>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.slide-enter-active {
    transition: all 0.2s;
}
.slide-enter-from {
    opacity: 0;
    max-height: 0px;
}
.slide-enter-to {
    opacity: 1;
    max-height: 140px;
}
.slide-leave-active {
    transition: all 0.3s;
}
.slide-leave-from {
    opacity: 1;
    max-height: 140px;
}
.slide-leave-to {
    opacity: 0;
    max-height: 0px;
}
</style>
