<template>
    <AppLayout>
        <div class="sm:grid grid-cols-4 p-10  px-8 gap-10 overflow-visible">
            <div class="col-span-2 gap-4 w-full">
                <div class="overflow-clip">
                    <Image
                        class="bg-white object-contain rounded-lg h-[30rem]"
                        :src="image.url"
                        :style="{
                            objectPosition:
                                image.x && image.y
                                    ? `${image.x * 1.3}% ${
                                          -image.y / 2 + 25
                                      }rem`
                                    : 'center',
                            transform: `scale(${image.scale})`,
                        }"
                    >
                        <template #error>
                            <div
                                class="w-full h-[30rem] flex items-center justify-center border rounded-md border-slate-300 bg-slate-50"
                            >
                                <svg
                                    class="mx-auto h-12 w-12 text-gray-400"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 48 48"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </template>
                    </Image>
                </div>

                <div class="grid grid-cols-3 gap-3 mt-3">
                   
                    <template
                        v-for="img in [
                            item.secondary_image_url,
                            item.tertiary_image_url,
                            item.quaternary_image_url,
                        ]"
                    >
                        <OnMouseInElement
                            v-if="img"
                            @mouse-on="
                                (isOutside, x, y) =>
                                    onHover(img, isOutside, x, y)
                            "
                            v-show="img"
                        >
                            <img
                                class="bg-white cursor-zoom-in hover:opacity-40 object-contain h-24 cols-span-2 rounded-lg"
                                :src="img"
                            />
                        </OnMouseInElement>
                    </template>
                </div>
            </div>
            <div class="col-span-2 space-y-3">
                <div class="flex justify-end w-full gap-2">

                    <Button
                        v-if="canEdit"
                            class="bg-red-500 text-white  py-2 rounded px-5 font-medium   border-slate-300 shadow"
                            @click="
                                $inertia.delete(route('products.destroy', item.slug))
                            "
                        >
                            Delete
                        </Button>
                    <Button
                        v-if="canEdit"
                            class="bg-blue-500 text-white  py-2 rounded px-8 font-medium   border-slate-300 shadow"
                            @click="
                                $inertia.visit(route('products.edit', item.slug))
                            "
                        >
                            Edit
                        </Button>
                </div>
                <div>
                    <div class="sm:flex justify-between">
                        <div class="space-y-2">
                            <input
                                class="text-2xl font-extrabold text-gray-900 capitalize w-full border-0 py-0 px-0 rounded-md pl-1 transition"
                                :disabled="!canEdit"
                                :value="props.item.name"
                            />


                        </div>
                        <MoneyInput v-model="props.item.price" v-if="canEdit" />
                        <p
                            v-else
                            class="text-2xl whitespace-nowrap text-gray-900 my-2 mb-10 sm:my-0"
                        >
                            <span class="text-md font-semibold"> RM </span>
                            {{ props.item.price }}
                        </p>
                    </div>

                    <section aria-labelledby="options-heading" class="mt-4">
                        <h3 id="options-heading" class="sr-only">
                            Product options
                        </h3>

                        <NumberStepper v-if="canBuy" v-model="form.quantity" />
                        <span
                            class="text-sm text-red-400"
                            v-if="form.quantity <= 0"
                        >
                            Please select a quantity
                        </span>
                        <Button
                            v-if="canBuy"
                            class="mt-2 w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white shadow-md"
                            @click="
                                () =>
                                    addToCart(item.id, form.quantity, {
                                        onComplete: () => (form.quantity = 1),
                                    })
                            "
                        >
                            Add to bag
                        </Button>
                    </section>
                    <section aria-labelledby="information-heading" class="mt-2">
                        <h3 id="information-heading" class="sr-only">
                            Product information
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ item.short_description }}
                            <h1 class="text-slate-800 font-semibold text-md mt-1">Description</h1>
                            {{ item.long_description }}
                        </p>
                    </section>
                </div>
            </div>
        </div>
        <div class="sm:grid sm:grid-cols-3 mx-8  space-y-8 gap-4 pb-10">
            <div>
                <RatingSection
                        :count="item.reviews_count"
                        :average="item.reviews_avg_rating"
                        :reviews="item.reviews"
                    />
                    <div class="mt-8 sm:hidden"
                    v-if="canReview">
                        <h1 class="text-xl font-medium ">Share your thoughts</h1>
                        <p class="text-slate-400 text-sm">
                            If you've used this product, share your thoughts with other customers
                        </p>
                        <Button class=" mt-4 border font-medium border-slate-400 text-slate-700 rounded-md px-4 py-2 shadow w-full">
                Write a review
                        </Button>
                    </div>
            </div>

            <ReviewSection
            :can-review="canReview"
        :product-slug="item.slug"
            class="sm:col-span-2 sm:pl-8" :reviews="reviews"/>
        </div>
        
    </AppLayout>
</template>
<script setup lang="ts">
interface Props {
    item: App.Models.FoodItem;
    canEdit: boolean;
    canBuy: boolean;
    canReview: boolean;
    reviews: Paginated<App.Models.Review>;
}

const props = withDefaults(defineProps<Props>(), {
    canEdit: false,
    canBuy: false,
    canReview: false,
});

import Button from "@/Components/Button.vue";
import NumberStepper from "@/Components/NumberStepper.vue";
import OnMouseInElement from "@/Components/OnMouseInElement.vue";
import RatingSection from "@/Components/RatingSection.vue";
import { useCart } from "@/Composables/cart";
import AppLayout from "@/Layouts/AppLayout.vue";
import type { Paginated } from "@/Types/Laravel";
import { reactive } from "vue";
import MoneyInput from "./MoneyInput.vue";
import ReviewSection from "./Partials/ReviewSection.vue";

const form = reactive({
    quantity: 1,
});
const image = reactive({
    url: props.item.image_url,
    x: 0,
    y: 0,
    scale: 1,
});
function onHover(img: string, inElement: boolean, x: number, y: number) {
    if (inElement) {
        image.url = img;
        image.x = x;
        image.y = y;
        image.scale = 2;
    } else {
        image.url = props.item.image_url;
        image.y = 50;
        image.x = 30;
        image.scale = 1;
    }
}

const { addToCart } = useCart();
</script>
