<script setup lang="ts">
import { computed } from "vue";

interface Props {
    delivery: App.Models.Delivery;
    order: App.Models.Order;
}
const props = defineProps<Props>();
const deliveryFee = computed(() => {
    return props.order.delivery_type == "Normal" ? 2 : 5;
});
const tax = computed(() => {
    return props.order.subtotal * 0.02;
});
const total = computed(() => {
    return props.order.subtotal + deliveryFee.value + tax.value;
});
</script>
<template>
    <div
        class="bg-slate-200/70 grid grid-cols-3 rounded border p-8 px-19 pb-10 gap-4"
    >
        <div>
            <h1 class="font-semibold text-md mb-2 text-blue-500">
                Billing Address
            </h1>
            <p class="text-sm text-slate-400">
                {{ delivery.to_first_line_address }}
            </p>
            <p class="text-slate-400 text-sm">
                {{ delivery.to_second_line_address }}
            </p>
            <p class="text-slate-400 text-sm">
                {{ delivery.to_city }}, {{ delivery.to_state }}
                {{ delivery.to_country }}
            </p>
        </div>

        <div>
            <h1 class="font-semibold text-md mb-2 text-blue-500">Subtotal</h1>
            <div class="grid grid-rows-3 divide-y divide-slate-300">
                <p
                    class="text-sm text-slate-400 py-2 w-full flex justify-between"
                >
                    <span class="font-medium pr-2">Subtotal </span>

                    <span class="text-slate-600 font-light">
                        MYR {{ order.subtotal }}
                    </span>
                </p>
                <p
                    class="text-slate-400 text-sm py-2 w-full flex justify-between"
                >
                    <span class="font-medium pr-2">Shipping </span>

                    <span class="text-slate-600 font-light">
                        MYR {{ deliveryFee }}
                    </span>
                </p>
                <p
                    class="text-slate-400 text-sm py-2 w-full flex justify-between"
                >
                    <span class="font-medium pr-2">Tax </span>

                    <span class="text-slate-600 font-light">
                        MYR {{ tax.toFixed(2) }}
                    </span>
                </p>
                <p
                    class="text-slate-400 text-sm py-2 w-full flex justify-between"
                >
                    <span class="font-semibold text-slate-500 pr-2"
                        >Order Total
                    </span>
                    <span class="text-blue-400 font-medium">
                        MYR {{ total.toFixed(2) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</template>
