<script setup lang="ts">
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faAppleAlt,
    faBowlRice,
    faBreadSlice,
    faCarrot,
    faFish,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { computed } from "vue";

library.add(faBreadSlice, faAppleAlt, faCarrot, faFish, faBowlRice);
interface Props {
    category: App.Models.FoodItem["category"];
}
const props = defineProps<Props>();
const icon = computed(() => {
    switch (props.category) {
        case "bread":
            return "fa-solid fa-bread-slice";
        case "cereal":
            return "fa-solid fa-bowl-rice";
        case "fish":
            return "fa-solid fa-fish";
        case "vegetable":
            return "fa-solid fa-carrot";
    }
    return "";
});
</script>
<template>
    <span
        class="bg-blue-500 h-8 w-8 rounded-full flex items-center justify-center z-5"
    >
        <FontAwesomeIcon :icon="icon" class="text-white"
    /></span>
</template>
