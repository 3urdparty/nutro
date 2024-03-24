<template>
    <HorizontalProgressBar
        class="w-3/4"
        start="8:00"
        end="10:00"
        :width="width"
    >
        <Marker :x="completion">
            <div class="flex gap-1 items-center">
                <TruckIcon class="w-5" />
                <span class="inline text-sm">{{ formatted }}</span>
            </div>
        </Marker>
    </HorizontalProgressBar>
</template>

<script setup lang="ts">
import HorizontalProgressBar from "@/Components/HorizontalProgressBar.vue";
import Marker from "@/Components/Marker.vue";
import { TruckIcon } from "@heroicons/vue/24/solid";
import { useDateFormat, useNow } from "@vueuse/core";
import { computed } from "vue";

interface Props {
    start: Date;
    end: Date;
}

const props = withDefaults(defineProps<Props>(), {
    start: () => new Date(1, 1, 1, 8, 0, 0),
    end: () => new Date(1, 1, 1, 10, 0, 0),
});
const now = useNow();

const formatted = useDateFormat(useNow(), "HH:mm");
const endX = computed(() => props.end.getHours() * 60 + props.end.getMinutes());
const startX = computed(
    () => props.start.getHours() * 60 + props.start.getMinutes()
);
const currentX = computed(
    () => now.value.getHours() * 60 + now.value.getMinutes()
);

const completion = computed(() => 0.2);

const width = computed(() => ((endX.value - startX.value) / 1500) * 100);
</script>
