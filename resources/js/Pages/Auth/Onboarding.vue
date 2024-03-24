<script setup lang="ts">
import ArrowButton from "@/Components/ArrowButton.vue";
import Stepper from "@/Components/Stepper.vue";
import Flicking from "@egjs/vue3-flicking";
import "@egjs/vue3-flicking/dist/flicking.css";
import { router } from "@inertiajs/vue3";
import { get } from "@vueuse/core";
import { ref } from "vue";
const currentStep = ref(0);
const slides = [
    {
        title: "Order your food with a click",
        description: "From the comfort of your home to your doorstep",
        image: "images/fast-delivery-scooter.png",
    },
    {
        title: "Order your food with a click",
        description: "From the comfort of your home to your doorstep",
        image: "images/online-party.png",
    },
    {
        title: "Order your food with a click",
        description: "From the comfort of your home to your doorstep",
        image: "images/robot-cook.png",
    },
    {
        title: "Order your food with a click",
        description: "From the comfort of your home to your doorstep",
        image: "images/tea-party.png",
    },
];

const flicking = ref<Flicking>();
const next = () => {
    if (get(currentStep) == 3) {
        router.visit(route("login"));
    } else {
        flicking.value.next();
        // set(currentStep, get(currentStep) + 1);
    }
};
</script>

<template>
    <div class="w-full flex justify-center py-10 flex-col gap-10 items-center">
        <Flicking
            ref="flicking"
            @changed="currentStep = $event.index"
            :options="{
                align: 'prev',
                horizontal: true,
                noPanelStyleOverride: true,
                panelsPerView: 1,
                moveType: ['strict', { count: 1 }],
                threshold: 30,
                bounce: '50%',
                preventDefaultOnDrag: true,
            }"
        >
            <div
                v-for="(slide, idx) in slides"
                :key="idx"
                class="w-full flex justify-center"
            >
                <img
                    :src="slide.image"
                    class="pointer-events-none w-80 object-contain"
                />
            </div>
        </Flicking>
        <!-- <div>
            <h1 class="font-bold text-2xl">{{ slide.title }}</h1>
            <p class="text-gray-400 font-medium">
                {{ slide.description }}
            </p>
        </div> -->
        <Stepper v-model="currentStep" :total="4" />
        <ArrowButton @click="next" />
    </div>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: all 0.5s ease;
}
.slide-enter-from,
.slide-leave-to {
    transform: translateX(100%);
}
.slide-enter-to,
.slide-leave-from {
    transform: translateX(0);
}
</style>
