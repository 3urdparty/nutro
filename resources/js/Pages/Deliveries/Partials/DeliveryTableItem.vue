<template>
    <tr class="group hover:bg-slate-50 transition cursor-pointer">
        <td
            class="pl-4 py-3 pb-2 whitespace-nowrap text-sm font-medium text-gray-900 w-2/3 hidden sm:block"
        >
            <ItemsOverview :items="delivery.order.items" />
        </td>

        <th
            class="hidden lg:table-cell pl-4 pb-4 whitespace-nowrap text-sm font-medium text-gray-900"
        >
            <span class="pl-2">
                <CustomerTag />
            </span>
        </th>
        <td
            class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right"
        >
            <Map
                :center="delivery.from.coord"
                :zoom="18"
                class="w-44 lg:w-60 h-20 lg:h-24 rounded-md overflow-clip shadow-sm focus:border focus:border-blue-400"
            >
                <Marker
                    :options="{
                        position: delivery.from.coord,
                    }"
                />
                <Marker
                    class="bg-blue-400"
                    :options="{ position: delivery.to.coord }"
                />
                <Polyline
                    :options="{
                        path: [delivery.from.coord, delivery.to.coord],
                        strokeColor: 'rgb(96 165 250)',
                        strokeOpacity: 0.75,
                        strokeWeight: 3,
                    }"
                />
            </Map>
        </td>
        <td
            class="px-6 table-cell py-3 whitespace-nowrap text-start text-sm font-medium text-slate-600 items-center"
        >
            <div class="flex items-center gap-1">
                <MapPinIcon class="text-red-400 w-4 mb-0.5" />
                {{ delivery.minimum_distance }}KM -
                {{ delivery.maximum_distance }}KM
            </div>
        </td>
        <td class="whitespace-nowrap text-right text-sm font-medium pr-4">
            <div class="flex gap-2">
                <Button
                    :disabled="!props.canAccept"
                    class="rounded-md p-2 bg-blue-500 text-white flex gap-1 items-center disabled:bg-blue-300 disabled:hover:cursor-not-allowed hover:bg-blue-400"
                    @click="acceptDelivery(delivery.id)"
                >
                    Accept
                    <CheckIcon class="w-4 h-4 text-white" />
                </Button>
                <Button
                    :disabled="!props.canAccept"
                    class="rounded-md p-2 bg-red-500 text-white flex items-center disabled:bg-red-300 disabled:hover:cursor-not-allowed hover:bg-red-400"
                >
                    Decline
                    <XMarkIcon class="w-4 h-4 text-white" />
                </Button>
            </div>
        </td>
    </tr>
</template>

<script setup lang="ts">
import CustomerTag from "@/Components/CustomerTag.vue";
import ItemsOverview from "@/Components/ItemsOverview.vue";
import Map from "@/Components/Map.vue";
import { CheckIcon, MapPinIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import { useAxios } from "@vueuse/integrations/useAxios";
import axios from "axios";
import { Marker, Polyline } from "vue3-google-map";
interface Props {
    delivery: App.Models.Delivery;
    canAccept: Boolean;
}
const props = withDefaults(defineProps<Props>(), {
    canAccept: () => false,
});

const instance = axios.create({});

const { execute } = useAxios({ method: "GET" }, instance);
const acceptDelivery = (deliveryId: number) => {
    if (props.canAccept)
        execute(route("deliveries.accept", deliveryId)).catch((err) => {
            console.log(err);
        });
};
</script>
