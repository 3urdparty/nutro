<template>
    <TransitionRoot as="template" :show="mobileFiltersOpen">
        <Dialog
            as="div"
            class="fixed inset-0 flex z-40 lg:hidden"
            @close="mobileFiltersOpen = false"
            :open="mobileFiltersOpen"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <TransitionChild
                as="template"
                enter="transition ease-in-out duration-300 transform"
                enter-from="translate-x-full"
                enter-to="translate-x-0"
                leave="transition ease-in-out duration-300 transform"
                leave-from="translate-x-0"
                leave-to="translate-x-full"
            >
                <div
                    class="ml-auto relative max-w-sm w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto"
                >
                    <div class="px-4 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            Category
                        </h2>
                        <button
                            type="button"
                            class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400"
                            @click="mobileFiltersOpen = false"
                        >
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4 border-t border-gray-200">
                        <h3 class="sr-only">Categories</h3>
                        <ul
                            role="list"
                            class="font-medium text-gray-900 px-4 py-4"
                        >
                            <li>
                                <label
                                    class="h-fit flex items-center gap-2 py-1"
                                >
                                    <input
                                        type="radio"
                                        name="category"
                                        value=""
                                        v-model="query.category"
                                    />
                                    All
                                </label>
                            </li>
                            <li
                                v-for="category in subCategories"
                                :key="category.name"
                            >
                                <label
                                    class="h-fit flex items-center gap-2 py-1"
                                >
                                    <input
                                        type="radio"
                                        name="category"
                                        :value="category.value"
                                        v-model="query.category"
                                    />
                                    {{ category.name }}
                                </label>
                            </li>
                        </ul>

                        <Disclosure
                            as="div"
                            v-for="section in filters"
                            :key="section.id"
                            class="border-t border-gray-200 px-4 py-6"
                            v-slot="{ open }"
                        >
                            <h3 class="-mx-2 -my-3 flow-root">
                                <DisclosureButton
                                    class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500"
                                >
                                    <span class="font-medium text-gray-900">
                                        {{ section.name }}
                                    </span>
                                    <span class="ml-6 flex items-center">
                                        <PlusIcon
                                            v-if="!open"
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        <MinusIcon
                                            v-else
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-6">
                                    <div
                                        v-for="(
                                            option, optionIdx
                                        ) in section.options"
                                        :key="option.value"
                                        class="flex items-center"
                                    >
                                        <input
                                            :id="option.value"
                                            :value="option.value"
                                            type="checkbox"
                                            v-model="query[section.id]"
                                            class="h-4 w-4 border-gray-300 rounded text-blue-600 focus:ring-blue-500"
                                        />
                                        <label
                                            :for="`filter-mobile-${section.id}-${optionIdx}`"
                                            class="ml-3 min-w-0 flex-1 text-gray-500"
                                        >
                                            {{ option.label }}
                                        </label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </form>
                </div>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
    <div :class="$attrs.class">
        <div class="flex justify-end sm:px-3 sm:py-2">
            <div class="flex gap-6 items-center">
                <div class="flex items-center z-20">
                    <Listbox
                        v-model="query.sort"
                        as="div"
                        class="relative inline-block text-left"
                    >
                        <div>
                            <ListboxButton
                                class="group inline-flex text-sm font-medium text-slate-600 hover:text-gray-900"
                            >
                                Sort
                                <ChevronDownIcon
                                    class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-slate-600 group-hover:text-gray-500"
                                    aria-hidden="true"
                                />
                            </ListboxButton>
                        </div>

                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <ListboxOptions
                                class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div class="py-1">
                                    <ListboxOption
                                        :value="option.name"
                                        v-for="option in sortOptions"
                                        :key="option.name"
                                        v-slot="{ active, selected }"
                                    >
                                        <button
                                            :href="option.href"
                                            :class="[
                                                selected
                                                    ? 'font-medium text-gray-900'
                                                    : 'text-gray-500',
                                                active ? 'bg-gray-100' : '',

                                                'block px-4 py-2 text-sm w-full text-left',
                                            ]"
                                        >
                                            {{ option.name }}
                                        </button>
                                    </ListboxOption>
                                </div>
                            </ListboxOptions>
                        </transition>
                    </Listbox>

                    <Button
                        type="button"
                        class="hidden sm:block p-2 -m-2 ml-5 sm:ml-7 text-blue-500 hover:text-gray-500 rounded-md"
                        @click="() => toggleLayout()"
                    >
                        <span class="sr-only">View grid</span>
                        <RectangleGroupIcon
                            class="w-5 h-5 text-slate-600"
                            aria-hidden="true"
                        />
                    </Button>
                    <Button
                        type="button"
                        class="p-2 -m-2 ml-4 sm:ml-6 text-slate-600 hover:text-gray-500 rounded-md lg:hidden"
                        @click="mobileFiltersOpen = true"
                    >
                        <span class="sr-only">Filters</span>
                        <FunnelIcon class="w-5 h-5" aria-hidden="true" />
                    </Button>
                </div>
            </div>
        </div>

        <main class="max-w-7xl mx-auto">
            <section aria-labelledby="products-heading" class="pt-4 pb-24">
                <h2 id="products-heading" class="sr-only">Products</h2>

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-x-8 gap-y-10">
                    <!-- Filters -->
                    <div class="hidden lg:block">
                        <h3 class="sr-only">Categories</h3>
                        <ul
                            role="list"
                            class="text-sm font-medium text-gray-900 space-y-4 pb-6 border-b border-gray-200"
                        >
                            <li
                                v-for="category in subCategories"
                                :key="category.name"
                            >
                                <Button
                                    @click="query.category = category.value"
                                    class="px-1"
                                    :class="[
                                        query.category === category.value
                                            ? 'text-blue-600'
                                            : 'text-gray-900',
                                        'group flex items-center  text-sm font-medium rounded-md',
                                    ]"
                                >
                                    {{ category.name }}
                                    <span
                                        class="text-xs text-slate-300 font-normal ml-1"
                                    >
                                        ({{
                                            filterByCategory(
                                                items,
                                                category.value
                                            ).length
                                        }})
                                    </span>
                                </Button>
                            </li>
                        </ul>

                        <Disclosure
                            as="div"
                            v-for="section in filters"
                            :key="section.id"
                            class="border-b border-gray-200 py-6"
                            v-slot="{ open }"
                        >
                            <h3 class="-my-3 flow-root">
                                <DisclosureButton
                                    class="py-3 w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500"
                                >
                                    <span class="font-medium text-gray-900">
                                        {{ section.name }}
                                    </span>
                                    <span class="ml-6 flex items-center">
                                        <PlusIcon
                                            v-if="!open"
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        <MinusIcon
                                            v-else
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-4">
                                    <div
                                        v-for="(
                                            option, optionIdx
                                        ) in section.options"
                                        :key="option.value"
                                        class="flex items-center"
                                    >
                                        <input
                                            type="checkbox"
                                            :value="option.value"
                                            v-model="query.vendors"
                                            class="h-4 w-4 border-gray-300 rounded text-blue-600 focus:ring-blue-500"
                                        />
                                        <label
                                            :for="`filter-${section.id}-${optionIdx}`"
                                            class="ml-3 text-sm text-gray-600"
                                        >
                                            {{ option.label }}
                                            <span
                                                class="text-slate-300 text-xs"
                                            >
                                                ({{
                                                    filterByVendor(items, [
                                                        option.value,
                                                    ]).length
                                                }})
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </div>

                    <div class="lg:col-span-4">
                        <div
                            v-if="processed.length > 0"
                            class="grid"
                            :class="[
                                layout
                                    ? 'grid-cols-1'
                                    : 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3',
                            ]"
                        >
                            <div
                                class="relative"
                                v-for="(item, idx) in processed"
                            >
                                <div
                                    class="absolute top-0 z-10 text-xs mt-3 left-0 ml-16 bg-yellow-400/50 px-1.5 py-0.5 rounded-b-md text-yellow-600"
                                    v-if="query.sort === 'Most Popular'"
                                >
                                    <span class="font-semibold text-md">
                                        #{{ idx + 1 }}
                                    </span>
                                    in {{ query.category ?? "foods" }}
                                </div>
                                <div
                                    class="absolute top-0 z-10 text-xs mt-3 left-0 ml-16 bg-yellow-400/50 px-1.5 py-0.5 rounded-b-md text-yellow-600 flex"
                                    v-if="
                                        query.sort === 'Best Rating' &&
                                        idx === 0
                                    "
                                >
                                    Top Pick
                                </div>

                                <ItemCard
                                    :item="item"
                                    :key="item.id"
                                    class="cursor-pointer z-0 sm:border sm:border-l-0 p-3 sm:first:border-l-0 sm:border-b-0 [&:nth-of-type(-n+3)]:border-t-0 sm:[&:nth-of-type(3n)]:bg-black"
                                    @liked=""
                                    @click="show"
                                />
                            </div>
                        </div>
                        <div
                            v-else
                            class="h-[20rem] w-full flex justify-center items-center"
                        >
                            <slot name="">
                                <div
                                    class="flex-col flex items-center w-full bg-white h-full p-4 rounded-md justify-center"
                                >
                                    <p class="text-sm text-slate-400">
                                        No products found... Try another
                                        <span class="font-semibold">
                                            search</span
                                        >
                                        maybe?
                                    </p>
                                    <img
                                        src="/images/robot-cook.png"
                                        class="w-40 opacity-80"
                                    />
                                </div>
                            </slot>
                        </div>
                    </div>
                    <ProductQuickView
                        :item="items[selectedItemIndex]"
                        :open="productPreviewOpen"
                        @close="productPreviewOpen = false"
                        class="z-50"
                    />
                </div>
            </section>
        </main>
    </div>
</template>

<script setup lang="ts">
import { useQuickView } from "@/Composables/quickview";
import {
    Dialog,
    DialogOverlay,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    RectangleGroupIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
import { useToggle } from "@vueuse/core";
import { computed, reactive, ref } from "vue";
import Button from "./Button.vue";
import ItemCard from "./ItemCard.vue";
import ProductQuickView from "./ProductQuickView.vue";
interface Props {
    items: Array<App.Models.FoodItem>;
    vendors: Array<App.Models.Vendor>;
}
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
    vendors: () => [],
});

const [layout, toggleLayout] = useToggle();
const productPreviewOpen = ref(false);
const selectedItemIndex = ref(null);
const sortOptions = [
    { name: "Most Popular", href: "#", current: true },
    { name: "Best Rating", href: "#", current: false },
    { name: "Newest", href: "#", current: false },
    { name: "Price: Low to High", href: "#", current: false },
    { name: "Price: High to Low", href: "#", current: false },
];

const subCategories = [
    { name: "Cereal", value: "cereal" },
    { name: "Vegetable", value: "vegetable" },
    { name: "Fish", value: "fish" },
    { name: "Bread", value: "bread" },
];
const { show } = useQuickView();
const filters = [
    {
        id: "vendors",
        name: "Vendor",
        options: props.vendors.map((vendor) => ({
            value: vendor.name,
            label: vendor.name,
            checked: false,
        })),
    },
];

const query = reactive({
    sort: null,
    category: null,
    vendors: props.vendors.map((vendor) => vendor.name),
});
const mobileFiltersOpen = ref(false);
const processed = computed(() => {
    let items = props.items;
    if (query.category) {
        items = filterByCategory(items, query.category);
    }

    items = filterByVendor(items, query.vendors);

    if (query.sort) {
        switch (query.sort) {
            case "Most Popular":
                items = items.sort((a, b) => b.reviews_count - a.reviews_count);
                break;
            case "Best Rating":
                items = items.sort(
                    (a, b) => b.reviews_avg_rating - a.reviews_avg_rating
                );
                break;
            case "Newest":
                break;
            case "Price: Low to High":
                items = items.sort((a, b) => a.price - b.price);
                break;
            case "Price: High to Low":
                items = items.sort((a, b) => b.price - a.price);
                break;
        }
    }

    return items;
});

const filterByCategory = (items: App.Models.FoodItem[], category: string) =>
    items.filter((item) => item.category === category);

const filterByVendor = (items: App.Models.FoodItem[], vendors: string[]) =>
    items.filter((item) => vendors.includes(item.vendor.name));
</script>
