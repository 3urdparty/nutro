<template>
    <Carousel class="bg-blue-300 m-8 rounded-lg overflow-clip">
        <div class="bg-blue-900 h-[30rem] relative" v-for="slide in slides">
            <div
                class="bg-white/80 w-[25rem] p-4 absolute top-0 mt-20 left-0 ml-20 z-40 rounded-md text-blue-600 font-medium"
            >
                <h1 class="text-slate-800 mt-2">Fresh Foods</h1>
                <h1 class="text-4xl font-bold mt-1">Discover Our Collection</h1>
                <p class="text-slate-700 text-sm font-normal">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
                    elit tellus, luctus nec ullamcorper mattis.
                </p>
                <Link
                    class="bg-blue-600 p-2 text-white rounded-md shadow-md px-4 mt-8"
                    :href="route('products.index')"
                >
                    Buy Now
                </Link>
            </div>
            <img
                :src="slide.image_url"
                class="object-cover rounded-md opacity-60"
            />
        </div>
    </Carousel>
</template>
<script setup lang="ts">
import Carousel from "@/Components/Carousel.vue";
import { Link } from "@inertiajs/vue3";
const slides = [
    {
        image_url: "/images/bern-fresen-q_oNX5UG9Xg.png",
    },
];
</script>
