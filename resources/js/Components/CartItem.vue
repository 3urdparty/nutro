<template>
    <li class="py-4 px-5 flex">
        <div
            class="flex-shrink-0 w-24 h-24 border border-slate-300 rounded-md overflow-clip"
        >
            <Image
                :src="item.image_url"
                :alt="item.name"
                class="w-full h-full object-center object-cover"
            />
        </div>

        <div class="ml-4 flex-1 flex flex-col">
            <div>
                <div
                    class="flex justify-between text-base font-medium text-gray-900"
                >
                    <h3>
                        <Link
                            class="capitalize font-semibold font-sora"
                            :href="
                                route('products.show', {
                                    product: item.slug,
                                })
                            "
                        >
                            {{ item.name }}
                        </Link>
                    </h3>

                    <p class="ml-4 font-sora">
                        <span class="font-semibold font-poppins"> RM </span>
                        {{ item.price }}
                    </p>
                </div>
            </div>
            <div class="flex items-center">
                <StarSelect
                    :model-value="item.reviews_avg_rating"
                    :count="item.reviews_count"
                    :total="5"
                    class="pt-2"
                />
                <span class="text-xs mt-1.5 text-slate-400 font-light"
                    >({{ item.reviews_count }})</span
                >
            </div>
            <p class="text-slate-400 text-sm">
                {{ item.short_description }}
            </p>
            <div class="flex-1 flex items-end justify-between text-sm">
                <p class="text-gray-500 font-semibold">
                    x{{ item.listing.quantity }}
                </p>

                <div class="flex">
                    <slot name="actions">
                        <button
                            @click="$emit('remove')"
                            type="button"
                            class="font-medium text-blue-600 hover:text-blue-500"
                        >
                            Remove
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </li>
</template>

<script setup lang="ts">
interface Props {
    item: App.Models.FoodItem;
}
import Image from "@/Components/Image.vue";
import { Link } from "@inertiajs/vue3";
import StarSelect from "./StarSelect.vue";
interface Emits {
    (event: "remove"): boolean;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
</script>
