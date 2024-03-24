<template>
    <div
        class="lg:flex lg:items-center lg:justify-between bg-white p-6 border rounded-md border-slate-300"
    >
        <div class="flex-1 min-w-0">
            <h2
                class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
            >
                Order #{{ order.id }}
            </h2>
            <div
                class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6"
            >
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <MapPinIcon
                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                    {{ order.delivery.to_city }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <CurrencyDollarIcon
                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                    MYR {{ order.subtotal.toFixed(2) }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <CalendarIcon
                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                    <p class="text-sm font-medium">
                        <span class="font-light text-slate-500">
                            Placed on
                        </span>
                        <span class="text-blue-400 font-medium">
                            {{
                                useDateFormat(order.created_at, "MMMM D, YYYY")
                                    .value
                            }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-5 flex lg:mt-0 lg:ml-4">
            <span>
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    <ShoppingCartIcon
                        class="-ml-1 mr-2 h-5 w-5 text-white"
                        aria-hidden="true"
                    />
                    Order Again
                </button>
            </span>

            <!-- Dropdown -->
            <Menu as="span" class="ml-3 relative sm:hidden">
                <MenuButton
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    More
                    <ChevronDownIcon
                        class="-mr-1 ml-2 h-5 w-5 text-gray-500"
                        aria-hidden="true"
                    />
                </MenuButton>

                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
                >
                    <MenuItems
                        class="origin-top-right absolute right-0 mt-2 -mr-1 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                    >
                        <MenuItem v-slot="{ active }">
                            <a
                                href="#"
                                :class="[
                                    active ? 'bg-gray-100' : '',
                                    'block px-4 py-2 text-sm text-gray-700',
                                ]"
                                >Edit</a
                            >
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <a
                                href="#"
                                :class="[
                                    active ? 'bg-gray-100' : '',
                                    'block px-4 py-2 text-sm text-gray-700',
                                ]"
                                >View</a
                            >
                        </MenuItem>
                    </MenuItems>
                </transition>
            </Menu>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    CalendarIcon,
    ChevronDownIcon,
    CurrencyDollarIcon,
    MapPinIcon,
    ShoppingCartIcon,
} from "@heroicons/vue/24/solid";
import { useDateFormat } from "@vueuse/core";
interface Props {
    order: App.Models.Order;
}
const props = defineProps<Props>();
</script>
