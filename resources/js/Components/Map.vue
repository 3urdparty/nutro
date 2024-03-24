<template>
    <GoogleMap
        :api-key="API_KEY"
        class="rounded-md overflow-clip focus:border focus:border-blue-400"
        v-bind="props"
        :styles="theme.googleMaps.styles"
    >
        <slot />
    </GoogleMap>
</template>
<script setup lang="ts">
import { theme } from "@/theme";
import { GoogleMap } from "vue3-google-map";

export type Coord = {
    lat: number;
    lng: number;
};
interface Props {
    center?: Coord;
    zoom?: number;

    draggable?: boolean;
    keyboardShortcuts?: boolean;
    clickableIcons?: boolean;
    fullscreenControl?: boolean;
    disableDefaultUi?: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    center: () => ({
        lat: 3.139003,
        lng: 101.686852,
    }),
    zoom: 16,

    draggable: false,
    keyboardShortcuts: false,
    clickableIcons: true,
    fullscreenControl: false,
    disableDefaultUi: true,
});
const API_KEY = import.meta.env.VITE_GOOGLE_MAPS_API_KEY;
</script>
