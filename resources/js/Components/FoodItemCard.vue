<script setup lang="ts">
import { HeartIcon } from "@heroicons/vue/24/solid";

interface Props {
    foodItem: App.Models.FoodItem;
}

const likeFoodItem = () => {
    props.foodItem.is_liked = !props.foodItem.is_liked;
};
const props = defineProps<Props>();
</script>
<template>
    <div
        class="bg-white rounded-lg p-2 shadow-sm border border-slate-300 space-y-2"
    >
        <div class="flex justify-between w-full">
            <div
                class="rounded-full bg-[#3FB7FB] w-8 h-8 flex justify-center items-center"
            >
                <FontAwesomeIcon icon="fa-solid fa-carrot" class="text-white" />
            </div>

            <span
                v-if="foodItem.quantity == 0"
                class="text-[#3FB7FB] font-medium text-md whitespace-nowrap trim hidden sm:block"
                >Out of stock</span
            >

            <button @click="likeFoodItem">
                <HeartIcon
                    class="w-5 h-5"
                    :class="[
                        foodItem.is_liked
                            ? 'fill-red-400'
                            : 'stroke-2 fill-none stroke-red-400',
                    ]"
                />
            </button>
        </div>
        <img :src="foodItem.image_url" />
        <div class="text-center">
            <h1 class="font-bold text-slate-600 capitalize">
                {{ foodItem.name }}
            </h1>
            <p class="text-slate-500 text-sm">
                {{ foodItem.short_description }}
            </p>

            <h1 class="text-xl font-bold font-sora text-slate-700">
                <span class="text-blue-300 font-medium pr-1 text-lg">RM</span
                >{{ foodItem.price }}
            </h1>
        </div>
    </div>
</template>
