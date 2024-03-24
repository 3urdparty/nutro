<template>
    <AppLayout class="bg-slate-50">
        <div class="p-10">
            <h1 class="text-3xl font-bold">Vendors</h1>
            <ul
                role="list"
                class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-8"
            >
                <li v-for="vendor in vendors" :key="vendor.id">
                    <VendorCard :vendor="vendor" />
                </li>
            </ul>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import VendorCard from "@/Pages/Vendors/Partials/VendorCard.vue";

interface Props {
    vendors: Array<App.Models.Vendor>;
}
const props = defineProps<Props>();
</script>
