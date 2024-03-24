<script setup lang="ts">
interface Props {
    order: App.Models.Order;
}
const props = defineProps<Props>();
</script>
<template>
    <form
        method="post"
        action="https://sandbox.senangpay.my/payment/225170270252536"
    >
        <input type="hidden" name="detail" :value="order.order_number" />
        <input type="hidden" name="amount" :value="order.subtotal.toFixed(2)" />
        <input type="hidden" name="order_id" :value="order.id" />
        <input type="hidden" name="name" :value="order.customer.user.name" />
        <input type="hidden" name="email" :value="order.customer.user.email" />
        <input
            type="hidden"
            name="phone"
            :value="order.customer.user.phone_number"
        />
        <input type="hidden" name="hash" :value="order.hash" />
        <Button
            class="border border-slate-400 rounded-md px-4 pb-[14px] pt-2 relative bg-blue-50 shadow-sm hover:bg-blue-100"
        >
            <img src="/images/banks/senangpay.png" class="w-20" />
        </Button>
    </form>
</template>
