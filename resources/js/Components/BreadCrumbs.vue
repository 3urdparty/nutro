<template>
    <div
        class="mx-auto px-4 sm:px-6 bg-white/95 border-b border-slate-300 shadow-sm"
    >
        <div class="border-t border-gray-200 py-2">
            <nav class="flex" aria-label="Breadcrumb">
                <div class="flex sm:hidden">
                    <Link
                        v-if="breadCrumbs.length > 1"
                        :href="breadCrumbs[breadCrumbs.length - 2].href"
                        class="group inline-flex space-x-3 text-sm font-medium text-gray-500 hover:text-gray-700"
                    >
                        <ArrowSmallLeftIcon
                            class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-600"
                            aria-hidden="true"
                        />

                        <span class="capitalize"
                            >Back to
                            {{ breadCrumbs[breadCrumbs.length - 2].name }}</span
                        >
                    </Link>
                    <Link
                        v-else
                        href="/"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <HomeIcon
                            class="flex-shrink-0 h-5 w-5"
                            aria-hidden="true"
                        />
                        <span class="sr-only">Home</span>
                    </Link>
                </div>
                <div class="hidden sm:block">
                    <ol role="list" class="flex items-center space-x-2">
                        <li>
                            <div>
                                <Link
                                    href="/"
                                    class="text-gray-400 hover:text-gray-500"
                                >
                                    <HomeIcon
                                        class="flex-shrink-0 h-5 w-5"
                                        aria-hidden="true"
                                    />
                                    <span class="sr-only">Home</span>
                                </Link>
                            </div>
                        </li>
                        <li
                            v-for="item in breadCrumbs"
                            :key="item.name"
                            v-if="breadCrumbs.length > 0"
                        >
                            <div class="flex items-center">
                                <svg
                                    class="flex-shrink-0 h-5 w-5 text-gray-300"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z"
                                    />
                                </svg>
                                <Link
                                    :href="item.href"
                                    class="ml-2 text-sm font-medium text-gray-500 hover:text-gray-700 capitalize"
                                    :aria-current="
                                        item.current ? 'page' : undefined
                                    "
                                    >{{ item.name }}</Link
                                >
                            </div>
                        </li>
                    </ol>
                </div>
            </nav>
        </div>
    </div>
</template>

<script setup lang="ts">
import * as changeCase from "change-case";
// const title = computed(() => {
//     if (params.search) {
//         return "Search Results";
//     } else if (params.category) {
//         return changeCase.capitalCase(params.category);
//     }
//     return "Products";
// });

import { ArrowSmallLeftIcon, HomeIcon } from "@heroicons/vue/20/solid";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const breadCrumbs = computed(() =>
    window.location.pathname
        .split("/")
        .slice(1)
        .map((item) => ({
            name: changeCase.capitalCase(item),
            href: "#",
            current: false,
        }))
        .filter((item) => item.name !== "")
);

const indexRoutes = ["products", "orders", "deals", "recipes"];
</script>
