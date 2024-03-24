<script setup lang="ts">
import BackButton from "@/Components/BackButton.vue";
import Button from "@/Components/Button.vue";
import CallButton from "@/Components/CallButton.vue";
import Card from "@/Components/Card.vue";
import ChatButton from "@/Components/ChatButton.vue";
import Chip from "@/Components/Chip.vue";
import CopyButton from "@/Components/CopyButton.vue";
import CustomerTag from "@/Components/CustomerTag.vue";
import ItemsOverview from "@/Components/ItemsOverview.vue";
import Map from "@/Components/Map.vue";

import { CheckIcon, MapIcon, MapPinIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { useGeolocation } from "@vueuse/core";
import { computed } from "vue";
import { Marker } from "vue3-google-map";
import DeliveryProgressBar from "./Partials/DeliveryProgressBar.vue";
interface Props {
    delivery: App.Models.Delivery;
}
const { coords, locatedAt, error, resume, pause } = useGeolocation();
const currentLocation = computed(() => ({
    lat: coords.value.latitude,
    lng: coords.value.longitude,
}));
const props = defineProps<Props>();
</script>
<template>
    <!-- <AppLayout> -->
    <div class="relative">
        <Map
            class="w-full h-screen rounded-none"
            :draggable="true"
            :clickable-icons="true"
            :center="{ ...currentLocation, lat: currentLocation.lat - 0.0035 }"
            :zoom="16"
        >
            <Marker
                :options="{
                    position: delivery.from.coord,
                    icon: '/images/map/default-pin.svg',
                }"
            />
            <Marker
                :options="{
                    position: delivery.to.coord,
                    icon: '/images/map/default-pin.svg',
                }"
            />

            <Marker
                class="animate-pulse"
                :options="{
                    position: currentLocation,
                    icon: '/images/map/delivery-pin.svg',
                    title: 'Your current location',
                    class: 'animate-pulse',
                }"
            />
        </Map>
        <div class="absolute top-2 left-2">
            <BackButton />
        </div>
        <div class="absolute z-20 bottom-2 w-full p-4">
            <Card
                class="bg-white rounded-lg border shadow-2xl border-slate-400 drop-shadow-2xl overflow-visible"
            >
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            <div class="flex items-center gap-1">
                                <h1 class="text-2xl font-bold text-blue-800">
                                    #{{ delivery.order.order_number }}
                                </h1>

                                <CopyButton
                                    class="mb-1"
                                    :text="delivery.order.order_number"
                                />
                                <Chip severity="info"> Ongoing </Chip>
                            </div>
                            <p
                                class="font-normal text-slate-400 text-md pb-2 flex items-start gap-1"
                            >
                                <MapPinIcon class="w-4 mt-0.5" />
                                {{ delivery.from.first_line_address }},
                                {{ delivery.from.city }}
                                {{ delivery.from.postcode }}
                            </p>
                        </div>

                        <div>
                            <div class="flex gap-2">
                                <CallButton />
                                <ChatButton />
                            </div>
                        </div>
                    </div>
                    <CustomerTag
                        :name="delivery.order.customer.user.name"
                        :image="delivery.order.customer.user.profile_photo_path"
                        class="mt-1"
                    />
                </template>

                <template #content>
                    <div class="pt-2">
                        <div class="flex w-full justify-between">
                            <DeliveryProgressBar />
                            <Button
                                class="bg-blue-500 rounded-full p-2 px-4 text-white font-medium flex gap-2 items-center"
                            >
                                <MapIcon class="w-5" />
                                Route
                            </Button>
                        </div>
                        <div>
                            <div class="flex justify-between mt-4">
                                <ItemsOverview
                                    class="w-full"
                                    :items="delivery.order.items"
                                />
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <Link
                        :href="route('deliveries.complete', delivery.id)"
                        class="bg-blue-500 w-full p-2 text-white rounded-md flex items-center justify-center gap-2 !ring-blue-500 !ring-offset-white transition hover:bg-blue-400"
                    >
                        Complete Delivery
                        <CheckIcon class="w-5" />
                    </Link>
                </template>
            </Card>
        </div>
    </div>
</template>
