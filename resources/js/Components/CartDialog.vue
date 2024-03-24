<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed inset-0 overflow-hidden"
            @close="$emit('close')"
        >
            <div class="absolute inset-0 overflow-hidden">
                <TransitionChild
                    as="template"
                    enter="duration-100 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-out duration-100"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                    <TransitionChild
                        as="template"
                        enter="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-from="translate-x-full"
                        enter-to="translate-x-0"
                        leave="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-from="translate-x-0"
                        leave-to="translate-x-full"
                    >
                        <div class="w-screen max-w-md">
                            <div
                                class="h-full flex flex-col bg-paper shadow-xl overflow-y-scroll"
                            >
                                <div
                                    class="flex-1 py-6 overflow-y-auto px-4 sm:px-6"
                                >
                                    <div
                                        class="flex items-start justify-between"
                                    >
                                        <DialogTitle
                                            class="text-lg font-medium text-gray-900 font-sora"
                                        >
                                            Shopping cart
                                        </DialogTitle>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button
                                                type="button"
                                                class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                                                @click="$emit('close')"
                                            >
                                                <span class="sr-only"
                                                    >Close panel</span
                                                >
                                                <XMarkIcon
                                                    class="h-6 w-6"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-8">
                                        <div class="flow-root">
                                            <ul
                                                role="list"
                                                class="-my-6 divide-y divide-gray-200"
                                                v-if="
                                                    props.items &&
                                                    props.items.length > 0
                                                "
                                            >
                                                <CartItem
                                                    v-for="item in items"
                                                    :key="item.id"
                                                    :item="item"
                                                    @remove="
                                                        removeItem(
                                                            item.cart_item.id
                                                        )
                                                    "
                                                ></CartItem>
                                            </ul>
                                            <div v-else>
                                                <p
                                                    class="text-center text-gray-500 font-sora"
                                                >
                                                    Your cart is empty
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="border-t border-gray-200 py-6 px-4 sm:px-6"
                                >
                                    <div
                                        class="flex justify-between text-base font-medium text-gray-900"
                                    >
                                        <p>Subtotal</p>
                                        <p>
                                            <span
                                                class="font-semibold text-blue-500"
                                            >
                                                RM
                                            </span>
                                            {{ subtotal.toFixed(2) }}
                                        </p>
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">
                                        Shipping and taxes calculated at
                                        checkout.
                                    </p>
                                    <div class="mt-6">
                                        <Link
                                            :href="route('cartItems.index')"
                                            class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 w-full"
                                            >Continue with Order</Link
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
                                                Continue Shopping<span
                                                    aria-hidden="true"
                                                >
                                                    &rarr;</span
                                                >
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import CartItem from "./CartItem.vue";
interface Props {
    open: boolean;
    items: Array<App.Models.FoodItem>;
}
interface Emits {
    (event: "close"): void;
}
const subtotal = computed(() => {
    return props.items
        .map((item) => item.price * item.quantity)
        .reduce((acc, curr) => acc + curr, 0);
});
const props = defineProps<Props>();
const emit = defineEmits<Emits>();
</script>

<script lang="ts">
export const removeItem = (id: number) => {
    Inertia.delete(route("cartItem.destroy", { cartItem: id }), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
