<script setup lang="ts">
import { ShoppingBagIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import Button from "./Button.vue";

interface Props {
    banner: string;
    bannerStyle: "success" | "danger" | "warning" | "info";
    link: string;
    linkHref: string;
    image_url?: string;
    type: "flash" | "activity";
    quantity: number;
    food_item: string;
}

interface Emits {
    (e: "close"): void;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
</script>
<template>
    <div class="inset-x-0 pb-2">
        <div class="mx-auto px-2">
            <div class="p-2 rounded-lg bg-white shadow-lg sm:p-3 border">
                <div class="flex justify-between flex-wrap">
                    <div class="w-0 flex-1 flex">
                        <div class="relative">
                            <img
                                :src="image_url"
                                class="w-20 h-20 rounded-md"
                            />
                            <span
                                class="absolute bottom-0 right-0 font-semibold text-blue-500"
                            >
                                x{{ quantity }}
                            </span>
                        </div>
                        <p
                            class="ml-3 font-medium text-sm text-slate-400 truncate"
                        >
                            {{ banner }}
                            <span
                                class="md:hidden block font-semibold text-md capitalize text-slate-700"
                            >
                                {{ food_item }}
                            </span>
                            <span class="hidden md:inline">
                                {{ banner }}
                            </span>
                        </p>
                    </div>
                    <div
                        class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto mr-2"
                    ></div>
                    <div
                        class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto"
                    >
                        <Button
                            @click="
                                $inertia.visit(route('cartItems.index'));
                                $emit('close');
                            "
                            class="flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 gap-2 items-center h-10"
                        >
                            View Cart
                            <ShoppingBagIcon class="w-4" />
                        </Button>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                        <Button
                            @click="$emit('close')"
                            type="button"
                            class="-mr-1 flex p-2 justify-center rounded-md bg-white border hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white text-blue-500 w-10 h-10"
                        >
                            <span class="sr-only">Dismiss</span>
                            <XMarkIcon
                                class="h-5 w-5 text-blue-400"
                                aria-hidden="true"
                            />
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
