<script setup lang="ts">
import { CheckCircleIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/inertia-vue3";
interface Props {
    items: Array<App.Models.FoodItem>;
}
const props = defineProps<Props>();
</script>
<template>
    <div class="bg-white shadow-sm overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="item in items" :key="item.id">
                <Link :href="route('products.show', { product: item.slug })">
                    <div class="block hover:bg-gray-50 border rounded-md">
                        <div class="flex items-center px-4 py-4">
                            <div class="min-w-0 flex-1 flex items-center">
                                <div class="flex-shrink-0">
                                    <img
                                        class="h-12 w-12 rounded"
                                        :src="item.image_url"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4"
                                >
                                    <div>
                                        <p
                                            class="text-sm font-medium text-indigo-600 truncate"
                                        >
                                            {{ item.name }}
                                        </p>
                                        <p
                                            class="mt-2 flex items-center text-sm text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-blue-500 pr-1"
                                            >
                                                RM
                                            </span>
                                            <span class="truncate">{{
                                                item.price
                                            }}</span>
                                        </p>
                                    </div>
                                    <div class="hidden md:block">
                                        <div>
                                            <p class="text-sm text-gray-900">
                                                Applied on
                                                {{ " " }}
                                                <!-- <time
                                                    :datetime="item.date"
                                                    >{{
                                                        item.dateFull
                                                    }}</time
                                                > -->
                                            </p>
                                            <p
                                                class="mt-2 flex items-center text-sm text-gray-500"
                                            >
                                                <CheckCircleIcon
                                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                                    aria-hidden="true"
                                                />
                                                {{ item.price }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ChevronRightIcon
                                    class="h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </div>
                        </div>
                    </div>
                </Link>
            </li>
        </ul>
    </div>
</template>
