<script setup lang="ts">
import Button from "@/Components/Button.vue";
import Card from "@/Components/Card.vue";
import { removeItem } from "@/Components/CartDialog.vue";
import CartItem from "@/Components/CartItem.vue";
import Page from "@/Components/Page.vue";
import { useCart } from "@/Composables/cart";
import AppLayout from "@/Layouts/AppLayout.vue";
interface Props {
    items: Array<App.Models.FoodItem>;
}
const { subtotal, placeOrder } = useCart();
defineProps<Props>();
</script>
<template>
    <AppLayout :show-cart="false">
        <Page>
            <Card>
                <template #header>
                    <div class="flex items-start justify-between">
                        <h1 class="text-3xl font-bold text-gray-900 font-sora">
                            Shopping cart
                        </h1>
                        <div class="ml-3 h-7 flex items-center">
                            <button
                                type="button"
                                class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                                @click="$emit('close')"
                            >
                                <span class="sr-only">Close panel</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </template>
                <template #content>
                    <div class="mt-8">
                        <div class="flow-root">
                            <ul
                                role="list"
                                class="-my-6 divide-y divide-gray-200"
                                v-if="items && items.length > 0"
                            >
                                <CartItem
                                    v-for="item in items"
                                    :key="item.id"
                                    :item="item"
                                    @remove="
                                        //@ts-ignore
                                        removeItem(itemlisting.id)
                                    "
                                />
                            </ul>
                            <div v-else>
                                <p class="text-center text-gray-500 font-sora">
                                    Your cart is empty
                                </p>
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                        <div
                            class="flex justify-between text-base font-medium text-gray-900"
                        >
                            <p>Subtotal</p>
                            <p>
                                <span class="font-bold">RM</span
                                >{{ subtotal.toFixed(2) }}
                            </p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">
                            Shipping and taxes calculated at checkout.
                        </p>
                        <div class="mt-6">
                            <Button
                                @click="placeOrder"
                                class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 w-full"
                                >Place Order</Button
                            >
                        </div>
                        <div
                            class="mt-6 flex justify-center text-sm text-center text-gray-500"
                        >
                            <p>
                                or
                                <button
                                    type="button"
                                    class="text-blue-600 font-medium hover:text-blue-500"
                                    @click="$emit('close')"
                                >
                                    Continue Shopping<span aria-hidden="true">
                                        &rarr;</span
                                    >
                                </button>
                            </p>
                        </div>
                    </div>
                </template>
            </Card>
        </Page>
    </AppLayout>
</template>
