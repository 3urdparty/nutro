<template>
    <div>
        <div class="group relative">
            <Image
                :src="props.item.image_url"
                :alt="props.item.name"
                @click="$emit('click', props.item)"
                class="w-full max-h-60 object-contain rounded-md sm:border border-slate-400 sm:shadow-sm bg-white text-center text-blue-400 group-hover:opacity-40 transition-opacity duration-300 aspect-square"
            />
            <div
                class="absolute top-0 left-0 flex justify-between w-full px-3 pt-3"
            >
                <CategoryIcon :category="item.category" />

                <HeartButton
                    :liked="isLiked"
                    @click="toggleLike(props.item)"
                    class="z-10 right-0"
                />
            </div>

            <div class="pl-2">
                <div class="flex justify-between w-full items-end mt-1">
                    <div class="my-1">
                        <button>
                            <h3
                                @click="$emit('click', props.item)"
                                class="text-md text-slate-700 capitalize font-medium group-hover:text-blue-400 transition-colors duration-300"
                            >
                                <span
                                    aria-hidden="true"
                                    class="absolute inset-0"
                                />
                                {{ props.item.name }}
                            </h3>
                        </button>
                    </div>

                    <div class="text-md text-end font-medium relative mt-3">
                        <span
                            class="text-sm text-slate-500/80 line-through block text-end absolute -top-3 right-0"
                            >{{ item.old_price }}
                        </span>

                        <p
                            class="pl-1 font-semibold text-lg text-blue-400 block whitespace-nowrap"
                        >
                            <span class="text-slate-400 font-medium text-sm">
                                RM
                            </span>
                            {{ item.price }}
                        </p>
                    </div>
                </div>
                <StarSelect :model-value="item.reviews_avg_rating" />
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import StarSelect from "@/Components/StarSelect.vue";
import { useLike } from "@/Composables/like";
import { ref } from "vue";
import CategoryIcon from "./CategoryIcon.vue";
import HeartButton from "./HeartButton.vue";
import Image from "./Image.vue";

interface Props {
    item: App.Models.FoodItem;
}
interface Emits {
    (e: "click", item: App.Models.FoodItem): void;
    (e: "liked", item: App.Models.FoodItem): void;
}

const itemCardEl = ref<HTMLDivElement>(null);
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const { likeItem, isLiked, toggleLike } = useLike(props.item);
</script>
