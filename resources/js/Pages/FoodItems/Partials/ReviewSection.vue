<template>
    <div class="pb-10">
        <h1 class="text-slate-800 font-semibold text-sm mt-1 hidden sm:block">
            Reviews
        </h1>
        <ReviewInput
            v-if="canReview"
            v-model:body="form.body"
            v-model:title="form.title"
            v-model:rating="form.rating"
            @submit="submit"
            :disabled="form.processing"
        />
        <ul class="pb-10">
            <li v-for="review in reviews.data">
                <div class="border-t border-slate-300 pt-8 mt-6">
                    <div class="flex items-center gap-1">
                        <StarSelect :model-value="review.rating" :total="5" />
                        <span class="text-sm text-slate-600">
                            {{ review.rating.toFixed(2) }}
                        </span>
                    </div>
                    <h1 class="font-semibold mt-4">
                        {{ review.title }}
                    </h1>
                    <p class="mt-2 text-md text-slate-400">
                        {{ review.body }}
                    </p>

                    <div class="mt-4">
                        <Link
                            href="#"
                            class="text-md font-medium text-blue-500 mr-2 hover:text-blue-700"
                        >
                            {{ review.customer.user.name }}
                        </Link>
                        <span class="text-slate-400"> | </span>
                        <span class="text-md text-slate-500 ml-2">
                            {{
                                useDateFormat(
                                    review.created_at,
                                    "MMM, DD, YYYY"
                                ).value
                            }}
                        </span>
                    </div>
                </div>
            </li>
        </ul>
        <Pagination v-bind="reviews" />
    </div>
</template>

<script setup lang="ts">
import Pagination from "@/Components/Pagination.vue";
import StarSelect from "@/Components/StarSelect.vue";
import type { Paginated } from "@/Types/Laravel";
import { Link, useForm } from "@inertiajs/vue3";
import { useDateFormat } from "@vueuse/core";
import ReviewInput from "../ReviewInput.vue";
interface Props {
    reviews: Paginated<App.Models.Review>;
    productSlug: string;
    canReview: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    canReview: false,
});

const form = useForm({
    rating: 0,
    title: "",
    body: "",
});

const submit = () => {
    form.post(route("products.reviews.store", { product: props.productSlug }), {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>
