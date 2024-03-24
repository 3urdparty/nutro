<template>
    <div>
        <div class="relative bottom-[4.5rem] mt-[20rem] sm:mt-48 md:mt-80">
            <div class="relative left-14 sm:left-1/3 w-[280px] z-20">
                <NutritionalLabel
                    variant="minimal"
                    :editable="false"
                    class="z-20 w-80 text-xs shadow-lg transition delay-[200ms]"
                    :class="[
                        targetIsVisible
                            ? 'scale-[1] opacity-100'
                            : 'scale-[0.1] opacity-0',
                    ]"
                />

                <Cursor
                    v-element-visibility="onElementVisibility"
                    ref="cursorEl"
                    class="absolute -top-5 visible:hidden z-20 transition-left duration-300 origin-top-left"
                    :class="[
                        targetIsVisible
                            ? 'left-32 -top-10 sm:left-0 md:-left-4'
                            : 'left-[15rem] top-40',
                    ]"
                />
            </div>
            <img
                src="/images/greenpeas.jpg"
                class="absolute z-10 w-[24rem] sm:w-[30rem] -top-60 left-8 border-4 rounded-lg border-dashed border-blue-400 overflow-clip"
            />
        </div>
    </div>
</template>
<script setup lang="ts">
import Cursor from "@/Components/Cursor.vue";
import NutritionalLabel from "@/Components/NutritionalLabel.vue";
import { vElementVisibility } from "@vueuse/components";
import { useElementVisibility } from "@vueuse/core";

const animate = ref(false);
function onElementVisibility() {
    console.log("visible");
    animate.value = true;
}

import { ref } from "vue";
const cursorEl = ref();
const targetIsVisible = useElementVisibility(cursorEl, {});

const onVisible = () => {
    // play();
};
</script>
