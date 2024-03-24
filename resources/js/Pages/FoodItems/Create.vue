<script setup lang="ts">
import Button from "@/Components/Button.vue";
import ImageSelect from "@/Components/ImageSelect.vue";
import MenuSelect from "@/Components/MenuSelect.vue";
import Page from "@/Components/Page.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Spinner from "@/Components/Spinner.vue";
import TextArea from "@/Components/TextArea.vue";
import TextInput from "@/Components/TextInput.vue";
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import type { InjectionKey } from "vue";
import MoneyInput from "./MoneyInput.vue";
interface Props {
    item: App.Models.FoodItem;
}
const props = withDefaults(defineProps<Props>(), {});
const { user } = useUser();
const form = useForm({
    vendor_id: 1,
    name: "",
    servings: 1,
    quantity: 1,
    unit: "g",
    protein: 1,
    carbohydrates: 1,
    calcium: 1,
    calories: 1,
    dietary_restriction: "None",
    category: "vegetable",
    units: 1,
    price: 10,
    short_description: "",
    long_description: "",
    image_url: "",
    secondary_image_url: "",
    tertiary_image_url: "",
    quaternary_image_url: "",
    ...props.item,
});

import { type MenuItem } from "@/Components/MenuSelect.vue";
const dietaryRestrictions: MenuItem[] = [
    {
        name: "None",
        value: "none",
    },
    {
        name: "Vegetarian",
        value: "vegetarian",
        icon: "/images/vegetarian.png",
    },

    {
        name: "Vegan",
        value: "vegan",
        icon: "/images/vegan.png",
    },
    {
        name: "Gluten Free",
        value: "gluten-free",
        icon: "/images/gluten-free.png",
    },
    {
        name: "Dairy Free",
        value: "dairy-free",
        icon: "/images/dairy-free.png",
    },
    {
        name: "Nut Free",
        value: "nut-free",
        icon: "/images/nut-free.png",
    },
    {
        name: "Kosher",
        value: "kosher",
        icon: "/images/kosher.png",
    },
    {
        name: "Halal",
        value: "halal",
        icon: "/images/halal.png",
    },
];
const categories = ["cereal", "vegetable", "fish", "bread"];
const units = ["g", "kg", "oz", "lb", "ml", "l", "fl oz", "pt", "gal"];
</script>

<template>
    <AppLayout class="bg-slate-50">
        <Page>
            <PageHeader v-model="form.name" placeholder="Product Name">
                <template #actions>
                    <div class="w-full space-y-2 sm:space-y-0 sm:flex gap-2">
                        <Button
                            class="inline-flex justify-center items-center px-4 border border-gray-300 rounded-md shadow-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none w-full sm:w-fit text-center py-2 text-lg"
                        >
                            Edit
                        </Button>
                        <Button
                            @click="form.post(route('products.store'))"
                            class="inline-flex bg-blue-500 items-center px-4 py-1.5 border-2 border-transparent rounded-md shadow-sm font-medium text-white hover:bg-blue-700 w-full sm:w-fit text-center justify-center text-lg gap-2"
                        >
                            {{ item ? "Save" : "Add" }}
                        </Button>
                    </div>
                </template>
            </PageHeader>

            <div class="md:grid grid-cols-4 overflow-visible">
                <div class="col-span-2 grid gap-4 grid-rows-4 h-[40rem]">
                    <ImageSelect v-model="form.image_url" class="row-span-3" />
                    <div class="flex gap-4">
                        <ImageSelect
                            v-model="form.image_url"
                            minimized
                            id="secondary"
                        />
                        <ImageSelect
                            v-model="form.secondary_image_url"
                            minimized
                            id="tertiary"
                        />
                        <ImageSelect
                            v-model="form.secondary_image_url"
                            minimized
                            id="quaternary"
                        />
                    </div>
                </div>
                <div class="w-full h-full col-span-2 mt-6">
                    <form action="" class="md:px-4 space-y-3">
                        <TextInput
                            v-model="form.short_description"
                            placeholder="Short Description..."
                            class="w-full"
                        />
                        <TextArea
                            v-model="form.long_description"
                            placeholder="Long Description"
                            class="w-full"
                        />
                        <MoneyInput v-model="form.price" />

                        <div class="flex gap-2">
                            <Spinner
                                v-model="form.units"
                                placeholder="Quantity"
                                class="w-4/5"
                            />
                            <MenuSelect
                                class="w-1/2"
                                :items="units"
                                v-model="form.unit"
                            />
                        </div>
                        <Spinner
                            v-model="form.servings"
                            placeholder="Servings"
                            class="w-4/5"
                        />
                        <MenuSelect
                            :items="dietaryRestrictions"
                            v-model="form.dietary_restriction"
                        >
                            <template #option="{ item }">
                                <button
                                    type="button"
                                    class="flex items-center gap gap-1 px-3 py-1.5 text-sm text-slate-600 hover:bg-blue-100 transition w-full"
                                >
                                    <img
                                        :src="(item as MenuItem).icon ?? (item as string)"
                                        class="w-6"
                                    />
                                    {{ (item as MenuItem).name ?? item }}
                                </button>
                            </template>
                        </MenuSelect>
                        <MenuSelect
                            :items="categories"
                            v-model="form.category"
                        />
                    </form>
                </div>
            </div>
            <!-- <div class="mt-10">
                <NutritionalLabel class="lg:block" />
            </div> -->
        </Page>
    </AppLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
<script lang="ts">
export const VendorsInjectionKey = Symbol("VENDORS") as InjectionKey<
    Array<App.Models.Vendor>
>;
</script>
