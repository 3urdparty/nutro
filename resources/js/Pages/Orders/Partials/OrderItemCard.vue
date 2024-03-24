<script setup lang="ts">
interface Props {
    order: App.Models.Order;
    canPay?: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    canPay: false,
});
import Button from "@/Components/Button.vue";
import Card from "@/Components/Card.vue";
import CartItem from "@/Components/CartItem.vue";
import Chip from "@/Components/Chip.vue";
import CopyButton from "@/Components/CopyButton.vue";
import SenangPayButton from "@/Components/SenangPayButton.vue";
import { ExclamationCircleIcon } from "@heroicons/vue/24/outline";
import { CalendarIcon, CurrencyDollarIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { useDateFormat } from "@vueuse/core";
import ShippingProgress from "./ShippingProgress.vue";
</script>
<template>
    <Card>
        <template #header>
            <div class="flex justify-between items-top">
                <div class="flex justify-between items-center gap-6">
                    <div>
                        <h1 class="font-medium text-sm hidden sm:block">
                            Order Number
                        </h1>
                        <div class="flex items-center gap-1">
                            <h1
                                class="text-blue-400 sm:font-medium font-bold sm:text-sm text-lg whitespace-nowrap"
                            >
                                #{{ order.order_number }}
                            </h1>
                            <CopyButton />
                        </div>
                    </div>

                    <div class="hidden sm:block">
                        <div class="flex gap-1">
                            <CalendarIcon class="w-4 text-slate-400" />
                            <h1 class="font-medium text-sm">Date placed</h1>
                        </div>
                        <h1
                            class="text-slate-400 font-normal text-sm whitespace-nowrap"
                        >
                            {{
                                useDateFormat(order.created_at, "MMM DD YYYY")
                                    .value
                            }}
                        </h1>
                    </div>
                    <div class="hidden sm:block">
                        <div class="flex gap-0.5 items-center">
                            <CurrencyDollarIcon
                                class="w-4 h-4 text-slate-400"
                            />
                            <h1 class="font-medium text-sm">Total amount</h1>
                        </div>
                        <h1
                            class="text-slate-400 font-normal text-sm whitespace-nowrap"
                        >
                            <span class="font-medium"> RM </span>
                            {{ order.subtotal }}
                        </h1>
                    </div>
                </div>

                <div class="flex gap-2">
                    <Button
                        @click="
                            $inertia.visit(
                                route('orders.show', {
                                    order: order.order_number,
                                })
                            )
                        "
                        class="bg-white p-1.5 py-3 border rounded-md shadow-sm text-slate-500 text-md text-md font-medium px-3 hover:bg-slate-50 whitespace-nowrap border-slate-400"
                        >View Order</Button
                    >
                    <div v-if="canPay">
                        <SenangPayButton :order="order" v-if="!order.payment" />
                        <Link
                            :href="
                                route('orders.invoice', {
                                    order: order.order_number,
                                })
                            "
                            class="bg-blue-500 flex justify-center items-c text-white p-1.5 py-2 border font-medium rounded-md border-blue-500 text-md text-md px-3 shadow-sm"
                            v-else
                        >
                            Print Invoice
                        </Link>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <ul>
                <li
                    class="flex flex-col justify-between items-center gap-4 border-b border-slate-100"
                >
                    <CartItem
                        :item="item"
                        v-for="item in order.items"
                        class="bg-white px-4 w-full rounded-md border border-slate-300"
                    >
                        <template #actions>
                            <div class="flex gap-2 divide-x text-xs">
                                <Button
                                    @click="
                                        $inertia.visit(
                                            route('products.show', {
                                                product: item.slug,
                                            })
                                        )
                                    "
                                    class="text-blue-500 font-medium px-0.5 rounded-md"
                                >
                                    View Product
                                </Button>
                                <Button
                                    @click="
                                        $inertia.visit(
                                            route('products.show', {
                                                product: item.slug,
                                            })
                                        )
                                    "
                                    class="text-blue-500 font-medium px-2.5 rounded-md"
                                >
                                    Buy Again
                                </Button>
                            </div>
                        </template>
                    </CartItem>
                </li>
            </ul>
        </template>
        <template #footer>
            <div class="bg-white py-4 px-6">
                <Chip severity="error" v-if="!order.payment" class="pl-1">
                    <ExclamationCircleIcon
                        class="w-4 h-4 mr-1.5"
                        aria-hidden="true"
                    />
                    Unpaid
                </Chip>

                <ShippingProgress :status="order.status" class="mt-2" v-else />
            </div>
        </template>
    </Card>
</template>
