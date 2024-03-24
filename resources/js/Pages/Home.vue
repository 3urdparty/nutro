<script setup lang="ts">
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import type { Grouped } from "@/Types/Laravel";
import { provide, ref } from "vue";
import DealsSection from "./Partials/DealsSection.vue";
import NutritionalLabelSection from "./Partials/NutritionalLabelSection.vue";
import ProductGrid from "./Partials/ProductGrid.vue";
import PromoSection from "./Partials/PromoSection.vue";
interface Props {
    canLogin: Boolean;
    canRegister: Boolean;
    categories: Grouped<App.Models.FoodItem>;
    vendors: Array<App.Models.Vendor>;
    discountedItems: Array<App.Models.FoodItem>;
}

const showModal = ref(false);
const props = withDefaults(defineProps<Props>(), {
    foodItems: () => ({ group: [] }),
    vendors: () => [],
});
const { is } = useUser();
provide("canLogin", props.canLogin);
provide("canRegister", props.canRegister);
</script>

<template>
    <AppLayout>
        <main class="sm:pt-10 lg:pt-0 pb-20">
            <PromoSection />
            <NutritionalLabelSection />

            <DealsSection :items="discountedItems" class="mt-10" />

            <section v-for="(items, category, idx) in categories">
                <ProductGrid
                    :class="idx === 0 ? 'mt-20' : ''"
                    :items="items"
                    :header="(category as string)"
                />
            </section>
        </main>
    </AppLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
