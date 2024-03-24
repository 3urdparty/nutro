<template>
    <div
        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
    >
        <div class="flex-1 flex justify-between sm:hidden">
            <Link
                :href="prev_page_url"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Previous
            </Link>
            <Link
                :href="next_page_url"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Next
            </Link>
        </div>
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium">{{ from }}</span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium">{{ to }}</span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium">{{ total }}</span>
                    {{ " " }}
                    results
                </p>
            </div>
            <div>
                <nav
                    class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <Link
                        :href="prev_page_url"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                    >
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </Link>
                    <!-- Current: "z-10 bg-blue-50 border-blue-500 text-blue-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <Link
                        v-for="link in leftLinks"
                        :href="link.url"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                        :class="[
                            link.active
                                ? 'bg-blue-50 border-blue-500 text-blue-600 z-10 '
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        ]"
                    >
                        {{ link.label }}
                    </Link>

                    <span
                        v-if="links.length > 5"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                    >
                        ...
                    </span>
                    <Link
                        v-if="leftLinks.length > 0"
                        v-for="link in rightLinks"
                        :href="link.url"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                        :class="[
                            link.active
                                ? 'bg-blue-50 border-blue-500 text-blue-600 z-10 '
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        ]"
                    >
                        {{ link.label }}
                    </Link>
                    <Link
                        href="#"
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                    >
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts" generic="T">
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
interface Props {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: {
        active: boolean;
        label: string;
        url: string | null;
    }[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

const leftLinks = computed(() =>
    props.links.slice(1, props.links.length - 1).slice(0, 2)
);

const rightLinks = computed(() =>
    props.links.length > 4
        ? [...props.links]
              .reverse()
              .slice(1, props.links.length - 1)
              .slice(0, 1)
              .reverse()
        : []
);
const props = defineProps<Props>();
</script>
