
<template>
    <TransitionRoot as="template" :show="open" >
        <Dialog
            as="div"
            class="overflow-y-auto  top-0  bg-white sm:bg-transparent fixed inset-0  z-10 scrollbar-none"
            @close="$emit('close')"
        >
            <div
                class="flex min-h-screen text-center md:block md:px-2 lg:px-4 overflow-y-auto scrollbar-none overscroll-contain scroll-mt-0 scroll-smooth"
                style="font-vendor: 0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:block"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden md:inline-block md:align-middle md:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                    enter-to="opacity-100 translate-y-0 md:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 md:scale-100"
                    leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                >
                    <div
                        class="flex text-base text-left transform transition w-full md:inline-block md:max-w-2xl md:px-4 md:my-8 md:align-middle lg:max-w-4xl"
                    >
                        <div
                            class="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8 md:rounded-md "
                        >
                            <button
                                type="button"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8"
                                @click="$emit('close')"
                            >
                                <span class="sr-only">Close</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <div
                                class="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:gap-x-8"
                            >
                                <div
                                    class="aspect-w-2 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden sm:col-span-4 lg:col-span-5 relative"
                                >
                                    <img
                                        :src="props.item.image_url"
                                        :alt="props.item.name"
                                        class="object-center object-cover"
                                    />
                                    <HeartButton v-model="props.item.is_liked" class="z-10 right-0 absolute mt-2 mr-2" />
                                    
                                </div>
                                
                                <div class="sm:col-span-8 lg:col-span-7">
                                    
                                    <h2
                                        class="text-2xl font-extrabold text-gray-900 sm:pr-12 capitalize"
                                    >
                                        {{ props.item.name }}
                                    </h2>

                                    <section
                                        aria-labelledby="information-heading"
                                        class="mt-2"
                                    >
                                        <h3
                                            id="information-heading"
                                            class="sr-only"
                                        >
                                            Product information
                                        </h3>

                                        <p class="text-2xl text-gray-900">
                                            <span class="font-semibold">
                                                RM
                                            </span>
                                            {{ props.item.price }}
                                        </p>

                                        <!-- Reviews -->
                                       



        
                                        <p class="text-sm text-gray-500">
                                            {{ item.short_description }}
                                        </p>


                                        <p class="text-sm text-gray-500">
                                            <h1 class="text-slate-800 font-semibold text-md mt-1">Description</h1>
                                            {{ item.long_description }}
                                        </p>
                                        
                                       <RatingSection :count="item.reviews_count" :average="item.reviews_avg_rating" :reviews="item.reviews"/>
                                        
                                    </section>

                                    <section
                                        aria-labelledby="options-heading"
                                        class="mt-10"
                                    >
                                        <h3
                                            id="options-heading"
                                            class="sr-only"
                                        >
                                            Product options
                                        </h3>
                                        <Link
                                            class="mt-6 w-full bg-white  border  rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-slate-700 border-slate-300 shadow-sm  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500  hover:bg-slate-100 active:bg-slate-200 "
                                            :href="
                                            route('products.show', {
                                                product: item.slug,
                                            })"
                                        >

                                            View Item Detail
                                        </Link>
                                        <Button
                                        v-if="is('customer')"
                                            class="mt-2 w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md"
                                            @click="addToCart"
                                        >
                                            Add to bag
                                        </Button>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
       
    </TransitionRoot>
</template>

<script setup lang="ts">
import { useUser } from "@/Composables/user";
import {
Dialog,
DialogOverlay,
TransitionChild,
TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";
import { reactive } from "vue";
import { number, object } from "yup";
import HeartButton from "./HeartButton.vue";
import RatingSection from "./RatingSection.vue";
interface Props {
    open: boolean;
    item: App.Models.FoodItem;
}
interface Emits {
    (e: "close"): void;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();

const {is} = useUser();
const productOptions = reactive({
    vendor: null,
    quantity: 1,
});

let schema = object().shape({
    quantity: number().required().min(1),
});
const addToCart = () => {
    schema
        .validate(productOptions, { abortEarly: false })
        .then((value) => {
            Inertia.post(
                route("cartItem.store"),
                {
                    ...value,
                    food_item_id: props.item.id,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        emits("close");
                    },
                }
            );
        })
        .catch((err) => {
            console.log(err);
        });
};
</script>
