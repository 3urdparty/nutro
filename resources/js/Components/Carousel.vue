<template>
    <div class="relative">
        <Flicking
            ref="flicking"
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
            <slot>
                <div class="bg-white h-[30rem]"></div>
            </slot>
        </Flicking>
        <div
            class="absolute bottom-0 left-0 w-full flex justify-center mb-5 z-10"
        >
            <Stepper v-model="step" :total="5" />
        </div>
        <Button
            class="absolute right-0 mr-4 z-10 top-1/2 -mt-5 w-8 h-8 rounded-full flex justify-center items-center text-white/90 shadow-lg"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                fill="currentColor"
            >
                <path
                    d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"
                />
            </svg>
        </Button>

        <Button
            class="absolute left-0 ml-4 z-10 top-1/2 -mt-5 w-8 h-8 rounded-full flex justify-center items-center text-white/90 shadow-lg"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                fill="currentColor"
            >
                <path
                    d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM271 135c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-87 87 87 87c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L167 273c-9.4-9.4-9.4-24.6 0-33.9L271 135z"
                />
            </svg>
        </Button>
    </div>
</template>
<script setup lang="ts">
import Flicking from "@egjs/vue3-flicking";
import "@egjs/vue3-flicking/dist/flicking.css";
import { ref, watch } from "vue";
import Stepper from "./Stepper.vue";
const flicking = ref(null);

const step = ref(0);
watch(step, (value) => {
    flicking.value.moveTo(value);
});
</script>
