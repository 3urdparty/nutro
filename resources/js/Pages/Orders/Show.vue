<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import OrderItemCard from "./Partials/OrderItemCard.vue";
import OrderPageHeader from "./Partials/OrderPageHeader.vue";
import PaymentDetails from "./Partials/PaymentDetails.vue";
interface Props {
    order: App.Models.Order;
    hash: string;
    canPay: boolean;
}
const props = defineProps<Props>();
</script>
<template>
    <AppLayout class="bg-slate-50">
        <div class="p-6 bg-slate-50 space-y-6 items-center py-8">
            <OrderPageHeader :order="order" />

            <OrderItemCard :hash="hash" :order="order" :can-pay="canPay" />

            <PaymentDetails :order="order" :delivery="order.delivery" />
        </div>
    </AppLayout>
</template>
