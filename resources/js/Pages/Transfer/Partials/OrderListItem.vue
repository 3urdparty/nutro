<script setup lang="ts">
import Card from "@/Components/Card.vue";
import { ChevronRightIcon, ShoppingCartIcon } from "@heroicons/vue/24/solid";

interface Props {
    order: App.Models.Order;
}
const props = defineProps<Props>();
</script>
<template>
    <Card>
        <template #header>
            <div class="flex items-center hover:bg-gray-50">
                <div
                    class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between"
                >
                    <div class="truncate">
                        <div class="flex text-sm">
                            <p class="text-slate-800 font-bold truncate">
                                Order #{{ order.id }}
                            </p>
                            <p
                                class="ml-1 flex-shrink-0 font-normal text-gray-500"
                            >
                                {{ order.order_number }}
                            </p>
                        </div>
                        <div class="mt-2 flex">
                            <div
                                class="flex items-center text-sm text-gray-500"
                            >
                                <ShoppingCartIcon
                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                                <p>
                                    Placed on
                                    {{ " " }}
                                    <time :datetime="order.created_at">{{
                                        order.created_at
                                    }}</time>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                        <div class="flex overflow-hidden -space-x-1">
                            <img
                                v-for="item in order.items"
                                :key="item.id"
                                class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                                :src="item.image_url"
                                :alt="item.name"
                            />
                        </div>
                    </div>
                </div>
                <div class="ml-5 flex-shrink-0">
                    <ChevronRightIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </div>
            </div>
        </template>
        <template #content> </template>
    </Card>
</template>
