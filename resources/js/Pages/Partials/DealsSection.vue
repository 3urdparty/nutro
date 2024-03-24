<template>
    <div class="relative overflow-visible">
        <div class="opacity-50">
            <div
                class="bg-gradient-to-b from-white from-20% absolute top-0 h-40 w-full"
            ></div>

            <img
                src="images/anna-tukhfatullina-food-photographer-stylist-Mzy-OjtCI70-unsplash.jpg"
                class="h-[30rem] w-full object-cover border-b border-slate-700"
            />
        </div>
        <div class="absolute -bottom-14 sm:-bottom-9 w-full px-2 sm:px-4">
            <div
                class="bg-white rounded-md border p-2 pr-3 border-slate-400 shadow-md mx-11 text-sm flex items-center gap-2 justify-between"
            >
                <div class="flex items-center gap-2">
                    <ExclamationCircleIcon class="w-5 text-blue-500" />
                    <p class="whitespace-nowrap">
                        <span class="hidden sm:inline">
                            These deals are only
                        </span>
                        <span class="capitalize sm:normal-case">
                            available
                        </span>
                        for a limited time!
                    </p>
                </div>

                <Link
                    :href="route('deals.index')"
                    class="text-blue-400 font-medium flex whitespace-nowrap items-center gap-1 group hover:text-blue-500"
                    >Learn more
                    <ArrowRightIcon
                        class="w-3 font-medium group-hover:translate-x-1 transform transition"
                    />
                </Link>
            </div>
            <h1 class="text-4xl font-bold text-black mx-12 mt-8">Deals</h1>
            <p class="font-medium text-slate-700 mx-12 mb-2">
                Catch the best deals on your favorite foods here before they run
                out in
                <span
                    class="font-semibold text-white text-border bg-blue-500 px-1 rounded-sm shadow-md whitespace-nowrap"
                >
                    {{ Math.floor((3600 * 8 - timepassed) / 3600) }}
                    :
                    {{ Math.floor((3600 * 8 - timepassed) / 60) % 60 }}
                    :
                    {{ (3600 * 8 - timepassed) % 60 }}
                </span>
                hours!
            </p>
            <div class="flex items-center relative">
                <Button
                    @click="next"
                    class="rounded-full bg-white z-10 h-10 w-8 px-0.5 items-center justify-center mr-1 border border-slate-400 shadow-md absolute right-0"
                >
                    <svg
                        class="text-slate-600 w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 512"
                        fill="currentColor"
                    >
                        <path
                            d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"
                        />
                    </svg>
                </Button>
                <Button
                    @click="previous"
                    class="rounded-full bg-white z-10 h-8 w-8 pl-0.5 items-center justify-center ml-1 border border-slate-400 shadow-md absolute left-0"
                >
                    <svg
                        class="text-slate-600 w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 512"
                        fill="currentColor"
                    >
                        <path
                            d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"
                        />
                    </svg>
                </Button>
                <div
                    class="gap-2 mx-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 w-full"
                >
                    <transition-group name="fade">
                        <div
                            class="bg-white shadow-md pb-10 rounded-md border p-2 border-slate-400 relative"
                            v-for="item in items.slice(
                                (step - 1) * itemCount,
                                step * itemCount
                            )"
                        >
                            <ItemCard :item="item" />

                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-t-md text-sm font-medium bg-blue-500/80 border border-blue-400 text-white absolute bottom-0 font-sora"
                            >
                                {{ item.discount }}% OFF
                            </span>
                        </div>
                    </transition-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import ItemCard from "@/Components/ItemCard.vue";
import { ArrowRightIcon, ExclamationCircleIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { breakpointsTailwind, useBreakpoints, useInterval } from "@vueuse/core";
import { computed, ref } from "vue";
const timepassed = useInterval(1000);

const next = () => {
    if (step.value < Math.ceil(props.items.length / itemCount.value)) {
        step.value++;
    }
};
const previous = () => {
    if (step.value > 1) {
        step.value--;
    }
};
const step = ref(1);
interface Props {
    items: Array<App.Models.FoodItem>;
}
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
});
const breakpoints = useBreakpoints(breakpointsTailwind);
const sm = breakpoints.smallerOrEqual("sm");
const md = breakpoints.between("sm", "md");
const lg = breakpoints.between("md", "lg");
const xl = breakpoints.greaterOrEqual("lg");
const itemCount = computed(() => {
    if (sm.value) return 1;
    if (md.value) return 2;
    if (lg.value) return 3;
    if (xl.value) return 4;
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
