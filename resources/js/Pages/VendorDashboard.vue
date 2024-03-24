<template>
    <AppLayout>
        <div class="px-4 py-8">
            <div
                class="border-b border-gray-200 px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
            >
                <div class="flex-1 min-w-0">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512"
                        class="w-10 h-10 text-blue-500"
                        fill="currentColor"
                    >
                        <path
                            d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"
                        />
                    </svg>
                    <h1
                        class="text-2xl mt-1 font-bold leading-6 text-slate-600 sm:truncate pb-5"
                    >
                        Welcome, {{ user.name }}
                    </h1>
                </div>
            </div>

            <!-- Stat Section -->
            <div class="mt-4 bg-blue-50 rounded-md py-3 pb-6 mx-2">
                <div class="flex items-center gap-2 mx-4">
                    <Button class="rounded-full">
                        <ChevronLeftIcon class="w-5 h-5 text-blue-500" />
                    </Button>
                    <h3 class="text-lg font-semibold text-blue-500">
                        Last 30 days
                    </h3>
                    <Button class="rounded-full">
                        <ChevronRightIcon class="w-5 h-5 text-blue-500" />
                    </Button>
                </div>
                <StatSection :stats="stats" class="sm:mx-4 mt-3" />
            </div>

            <section>
                <div class="mt-8 sm:mx-4">
                    <div class="flex justify-between items-start">
                        <h1 class="text-2xl font-bold capitalize text-blue-500">
                            My Products
                        </h1>

                        <Button
                            @click="$inertia.visit(route('products.create'))"
                            class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white rounded-md p-3 font-medium shadow-sm !ring-offset-white !ring-blue-500"
                        >
                            Add Product
                        </Button>
                    </div>
                    <p class="text-sm text-slate-400 -mt-2">
                        Your available products
                    </p>
                </div>
                <ProductGrid :header="'Hey'" :items="foodItems.data" />
                <Pagination v-bind="foodItems" />
            </section>

            <section class="mt-10">
                <h1 class="font-bold text-3xl text-blue-500 mx-3 mt-5 mb-3">
                    Orders
                </h1>
                <hr />
                <div class="overflow-hidden mt-4 mx-3">
                    <ul
                        role="list"
                        class="space-y-5 md:space-y-8 lg:space-y-10"
                    >
                        <li v-for="(order, idx) in orders.data" :key="order.id">
                            <div class="space-y-3">
                                <div
                                    class="flex w-full justify-between items-center"
                                >
                                    <div class="flex items-center">
                                        <span
                                            class="font-bold text-3xl mr-2 text-blue-500"
                                            >#{{ idx + 1 }}
                                        </span>
                                        <CustomerTag class="inline" />
                                    </div>

                                    <Chip severity="success"
                                        >+RM{{ order.subtotal }}</Chip
                                    >
                                </div>
                                <OrderItemCard
                                    :order="order"
                                    class="!shadow-md"
                                />
                            </div>
                        </li>
                    </ul>
                </div>
                <Pagination v-bind="foodItems" />
            </section>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import Button from "@/Components/Button.vue";
import Chip from "@/Components/Chip.vue";
import CustomerTag from "@/Components/CustomerTag.vue";
import Pagination from "@/Components/Pagination.vue";
import StatSection, { type Statistic } from "@/Components/StatSection.vue";
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import type { Paginated } from "@/Types/Laravel";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
    CurrencyDollarIcon,
    TruckIcon,
} from "@heroicons/vue/24/solid";
import OrderItemCard from "./Orders/Partials/OrderItemCard.vue";
import ProductGrid from "./Partials/ProductGrid.vue";

interface Props {
    foodItems: Paginated<App.Models.FoodItem>;
    orders: Paginated<App.Models.Order>;
    items_sold: number;
    total_earnings: number;
    customer_count: number;
}

const props = withDefaults(defineProps<Props>(), {
    items_sold: 0,
    total_earnings: 0,
    customer_count: 0,
});
const stats: Statistic[] = [
    {
        id: 1,
        name: "Total Items Sold",
        stat: props.items_sold,
        icon: TruckIcon,
        change: props.items_sold,
    },
    {
        id: 2,
        name: "Money Earned",
        stat: props.total_earnings,
        prefix: "$",
        icon: CurrencyDollarIcon,
        change: props.total_earnings, // get older statistics too
    },
];

const { user } = useUser();
</script>
