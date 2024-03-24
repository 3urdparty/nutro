<template>
    <AppLayout>
        <div class="flex-1">
            <div
                class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 pt-10"
            >
                <div class="flex-1 min-w-0">
                    <h1
                        class="text-2xl font-bold leading-6 text-slate-600 sm:truncate"
                    >
                        Welcome, {{ user.name }}
                    </h1>
                </div>
            </div>

            <div class="px-6 pt-3">
                <DeliveryDashboardStatsSection :stats="stats" />
            </div>
            <!-- Current Deliveries -->
            <div class="px-6 pt-10 sm:px-6 lg:px-8 space-y-4">
                <h1 class="text-2xl font-bold">My Deliveries</h1>
            </div>
            <ul
                role="list"
                class="flex gap-10 mt-3 overflow-x-scroll overflow-y-none p-6 pl-10 items-bottom scrollbar-none"
                v-if="my_deliveries.length > 0"
            >
                <DeliveryCard
                    :can-start="canStart"
                    v-for="(delivery, idx) in current_deliveries"
                    :delivery="delivery"
                    :key="idx"
                />
            </ul>
            <div
                class="bg-slate-50 mt-2 h-40 rounded-md w-full flex justify-center items-center"
                v-else
            >
                <p class="text-slate-400">No current deliveries</p>
            </div>

            <!-- Delivery table (small breakpoint and up) -->
            <div class="pt-10 space-y-4">
                <h1 class="text-2xl font-bold px-4">Available Deliveries</h1>

                <DeliveryList
                    :deliveries="available_deliveries.data"
                    :can-accept="canAccept"
                />
                <Pagination v-bind="available_deliveries" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import DeliveryCard from "@/Components/DeliveryCard.vue";
import Pagination from "@/Components/Pagination.vue";
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import DeliveryList from "@/Pages/Deliveries/Partials/DeliveryList.vue";
import type { Paginated } from "@/Types/Laravel";
import { CurrencyDollarIcon, TruckIcon } from "@heroicons/vue/24/solid";
import Pusher from "pusher-js";
import { computed, ref } from "vue";
import DeliveryDashboardStatsSection, {
    type Statistic,
} from "./Partials/DeliveryDashboardStatsSection.vue";

interface Props {
    deliveries: Paginated<App.Models.Delivery>;
    my_deliveries: App.Models.Delivery[];
    money_earned: {
        current: number;
        previous: number;
    };
    completed: {
        current: number;
        previous: number;
    };
}

const props = defineProps<Props>();

const stats: Statistic[] = [
    {
        id: 1,
        name: "Total Deliveries",
        stat: props.completed.current,
        icon: TruckIcon,
        change: props.completed.previous,
    },
    {
        id: 2,
        name: "Money Earned",
        stat: props.completed.current,
        prefix: "$",
        icon: CurrencyDollarIcon,
        change: props.completed.previous,
    },
];

const { user } = useUser();

const available_deliveries = ref(props.deliveries);
const current_deliveries = ref(props.my_deliveries);

const canStart = computed(
    () =>
        current_deliveries.value.filter((d) => d.status === "in_progress")
            .length == 0
);
Pusher.logToConsole = true;
const pusher = new Pusher("15b522e23411e6ef8cb7", {
    cluster: "ap1",
});
var channel = pusher.subscribe("deliveries");

channel.bind(
    "delivery-accepted",
    function (data: { delivery_id: number; delivery_person_id: number }) {
        const idx = available_deliveries.value.data.findIndex(
            (deli) => deli.id === data.delivery_id
        );

        const delivery = available_deliveries.value.data.splice(
            available_deliveries.value.data.findIndex(
                (deli) => deli.id === data.delivery_id
            ),
            1
        )[0];

        console.log(data.delivery_person_id, user.value.id);
        if (data.delivery_person_id === user.value.id) {
            current_deliveries.value.push(delivery);
        }
    }
);
channel.bind("delivery-added", function (delivery: App.Models.Delivery) {
    available_deliveries.value.data.push(delivery);
});

const canAccept = computed(
    () =>
        current_deliveries.value.filter((d) => d.status !== "completed")
            .length < 3
);
</script>
