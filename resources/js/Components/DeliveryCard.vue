<template>
    <div>
        <Card
            class="bg-white rounded-md shadow-md border hover:bg-slate-50 transition hover:scale-[1.01] cursor-pointer group relative"
        >
            <div
                class="absolute left-0 top-0 mt-1 ml-1rounded-full p-1 w-12 h-12 z-10"
                v-if="delivery.status === 'completed'"
            >
                <CheckCircleIcon class="w-full h-full text-blue-400" />
            </div>
            <div
                :class="{
                    'opacity-40 disabled ': delivery.status === 'completed',
                    'opacity-100 scale-105': delivery.status === 'in_progress',
                }"
            >
                <Map
                    :center="delivery.from.coord"
                    class="w-full h-40 rounded-t-md overflow-clip focus:border focus:border-blue-400 rounded-b-none pointer-events-none"
                >
                    <Marker :options="{ position: delivery.from.coord }" />
                    <Marker :options="{ position: delivery.to.coord }" />
                    <Polyline
                        :options="{
                            path: [delivery.from.coord, delivery.to.coord],
                            strokeColor: 'rgb(96 165 250)',
                            strokeOpacity: 0.75,
                            strokeWeight: 3,
                        }"
                    />
                </Map>
                <div class="p-2 px-3 w-full space-y-4">
                    <div
                        class="flex justify-between items-center pt-0.5 pr-0.5"
                    >
                        <h1
                            class="font-medium font-sora px-1 text-md text-slate-400 whitespace-nowrap"
                        >
                            <span class="font-semibold text-slate-500 text-sm">
                                Order
                            </span>
                            <span
                                class="font-bold text-blue-500/80 ordinal slashed-zero lining-nums tabular-nums"
                            >
                                #{{ delivery.order.order_number }}
                            </span>
                        </h1>
                        <Chip
                            class="hidden md:block capitalize"
                            :severity="severity"
                        >
                            {{ status }}
                        </Chip>
                    </div>
                    <div
                        class="flex gap-2 sm:gap-4 justify-start items-top w-full px-1"
                    >
                        <VerticalProgressBar
                            v-if="delivery.status === 'in_progress'"
                            orientation="vertical"
                        />
                        <div class="w-full space-y-3">
                            <CustomerTag
                                :name="delivery.order.customer.user.name"
                                :image="
                                    delivery.order.customer.user
                                        .profile_photo_path
                                "
                            />
                            <ItemsOverview :items="delivery.order.items" />
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <Link
                        v-if="delivery.status === 'in_progress'"
                        :href="route('deliveries.show', delivery.id)"
                        class=""
                    >
                        <div
                            class="w-full bg-blue-500 rounded-md py-2 px-2 text-white font-medium hover:bg-blue-400 text-center"
                        >
                            View Delivery
                        </div>
                    </Link>
                    <Link
                        v-if="delivery.status === 'pending' && canStart"
                        :href="route('deliveries.start', delivery.id)"
                        class=""
                    >
                        <div
                            class="w-full bg-blue-500 rounded-md py-2 px-2 text-white font-medium hover:bg-blue-400 text-center"
                        >
                            Start Delivery
                        </div>
                    </Link>
                </div>
            </div>
        </Card>
    </div>
</template>
<script setup lang="ts">
import Card from "@/Components/Card.vue";
import Chip from "@/Components/Chip.vue";
import ItemsOverview from "@/Components/ItemsOverview.vue";
import { useChangeCase } from "@vueuse/integrations/useChangeCase";
// import Link from "@/Components/Link.vue";
import Map from "@/Components/Map.vue";
import VerticalProgressBar from "@/Components/VerticalProgressBar.vue";
import { CheckCircleIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { Marker, Polyline } from "vue3-google-map";
import CustomerTag from "./CustomerTag.vue";

interface Props {
    delivery: App.Models.Delivery;
    canStart: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    canStart: false,
});
const severity = computed(() => {
    switch (props.delivery.status) {
        case "pending":
            return "info";
        case "in_progress":
            return "info";
        case "completed":
            return "success";
        default:
            return "info";
    }
});
const status = useChangeCase(props.delivery.status, "capitalCase");
</script>
