<script setup lang="ts">
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pusher from "pusher-js";
import { ref } from "vue";
import DeliveryList from "./Partials/DeliveryList.vue";
interface Props {
    deliveries: App.Models.Delivery[];
}
const props = defineProps<Props>();
const available_deliveries = ref(props.deliveries);

Pusher.logToConsole = true;
const pusher = new Pusher("15b522e23411e6ef8cb7", {
    cluster: "ap1",
});
var channel = pusher.subscribe("deliveries");

const { user } = useUser();

channel.bind(
    "delivery-accepted",
    function (data: { delivery_id: number; delivery_person_id: number }) {
        const idx = available_deliveries.value.findIndex(
            (deli) => deli.id === data.delivery_id
        );

        const delivery = available_deliveries.value.splice(
            available_deliveries.value.findIndex(
                (deli) => deli.id === data.delivery_id
            ),
            1
        )[0];
    }
);
channel.bind("delivery-added", function (delivery: App.Models.Delivery) {
    available_deliveries.value.push(delivery);
});
</script>
<template>
    <AppLayout>
        <div class="pt-7 px-5">
            <h1 class="text-3xl font-bold">Orders</h1>
            <p class="text-slate-400">All orders ready for delivery</p>
        </div>
        <DeliveryList :deliveries="available_deliveries.slice(0, 4)" />
    </AppLayout>
</template>
