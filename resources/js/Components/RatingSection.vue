<template>
    <div class="mt-6">
        <h1 class="text-slate-800 font-semibold text-sm mt-1">Ratings</h1>
        <h4 class="sr-only">Ratings</h4>

        <div class="flex items-center">
            <StarSelect :total="5" :count="count" :model-value="average" />
            <span class="text-xs text-slate-400"> ({{ count }}) </span>
        </div>

        <ul class="my-3">
            <li class="space-y-1 my-1" v-for="num in 5">
                <div class="flex items-center gap-0.5">
                    <span
                        class="gap-0.5 text-sm text-slate-500 w-3 text-center"
                    >
                        {{ num }}
                    </span>
                    <StarIcon class="text-orange-400 w-4 h-4" />
                    <div
                        class="bg-slate-100/70 w-full rounded-full h-2.5 border-slate-300 border"
                    >
                        <div
                            class="bg-orange-400 h-full rounded-full"
                            :style="{
                                width:
                                    (reviews.length > 1
                                        ? reviews.filter(
                                              (review) => review.rating === num
                                          ).length / reviews.length
                                        : 0) *
                                        100 +
                                    '%',
                            }"
                        ></div>
                    </div>
                    <span
                        class="text-xs font-normal ml-1 text-slate-400 ordinal slashed-zero tabular-nums lining-nums font-sora"
                        >({{
                            reviews.filter((review) => review.rating === num)
                                .length
                        }})</span
                    >
                </div>
            </li>
        </ul>
    </div>
</template>
<script setup lang="ts">
import StarSelect from "./StarSelect.vue";

interface Props {
    reviews: Array<App.Models.Review>;
    average: number;
    count: number;
}
const props = defineProps<Props>();
</script>
