<template>
    <div>
        <div class="grid grid-cols-2 sm:grid-cols-3 pt-2">
            <div
                class="p-3 sm:p-4 border-r border-b last:border-r-0 last:border-b-0 even:border-r-0 sm:even:border-r sm:[&:nth-of-type(3n)]:border-r-0 sm:[&:nth-last-child(-n+3)]:border-b-0 [&:nth-last-child(-n+2)]:border-b-0 relative group"
                v-for="(item, idx) in items"
            >
                <ItemCard :item="item" @click="show" />
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import ItemCard from "@/Components/ItemCard.vue";
import { useQuickView } from "@/Composables/quickview";
const { show } = useQuickView();

interface Emits {
    (e: "addToCart", id: number): void;
}
const emits = defineEmits<Emits>();
interface Props {
    items: Array<App.Models.FoodItem>;
    header: string;
}
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
    header: "Products",
});
</script>
