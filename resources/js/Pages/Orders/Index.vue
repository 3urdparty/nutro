<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
interface Props {
    orders: Array<App.Models.Order>;
    canPay: boolean;
}
const props = defineProps<Props>();

import Page from "@/Components/Page.vue";
import PageHeader from "@/Components/PageHeader.vue";
import OrderItemCard from "@/Pages/Orders/Partials/OrderItemCard.vue";
</script>

<template>
    <AppLayout class="bg-slate-50">
        <Page>
            <PageHeader> </PageHeader>
            <div class="px-5 pb-5">
                <h1 class="text-3xl font-bold text-slate-800 px-1">
                    Order History
                </h1>
                <p class="text-sm text-slate-400 pl-2">
                    Check the status of recent orders, manage returns and
                    discover similar products
                </p>
                <div class="overflow-hidden mt-10 lg:mt-12">
                    <ul
                        role="list"
                        class="space-y-5 md:space-y-8 lg:space-y-10"
                    >
                        <li v-for="order in orders" :key="order.id">
                            <OrderItemCard
                                :can-pay="canPay"
                                :order="order"
                                class="m-1.5 !shadow-md"
                            />
                        </li>
                    </ul>
                </div>
            </div>
        </Page>
    </AppLayout>
</template>
