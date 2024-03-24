<!-- TODO:Formalize this into a general component -->
<template>
    <div>
        <h3 class="text-lg leading-6 font-semibold text-blue-500">
            Last 30 days
        </h3>

        <dl class="mt-5 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="item in stats"
                :key="item.id"
                class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden border"
            >
                <dt>
                    <div class="absolute bg-blue-500 rounded-md p-3">
                        <component
                            :is="item.icon"
                            class="h-6 w-6 text-white"
                            aria-hidden="true"
                        />
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">
                        {{ item.name }}
                    </p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ item.prefix }}{{ item.stat }}
                    </p>
                    <p
                        :class="[
                            item.stat > item.change
                                ? 'text-green-600'
                                : item.stat < item.change
                                ? 'text-red-600'
                                : 'text-gray-600',
                            'ml-2 flex items-baseline text-sm font-semibold',
                        ]"
                    >
                        <ArrowSmallUpIcon
                            v-if="item.stat > item.change"
                            class="self-center flex-shrink-0 h-5 w-5 text-green-500"
                            aria-hidden="true"
                        />
                        <ArrowSmallDownIcon
                            v-else-if="item.stat < item.change"
                            class="self-center flex-shrink-0 h-5 w-5 text-red-500"
                            aria-hidden="true"
                        />
                        <MinusIcon
                            v-else
                            class="self-center flex-shrink-0 h-5 w-5 text-gray-400"
                            aria-hidden="true"
                        />
                        <span class="sr-only">
                            {{
                                item.stat > item.change
                                    ? "Increased"
                                    : "Decreased"
                            }}
                            by
                        </span>
                        {{ item.prefix }}{{ item.change }}
                    </p>
                    <div
                        class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6"
                    >
                        <div class="text-sm">
                            <a
                                href="#"
                                class="font-medium text-blue-600 hover:text-blue-500"
                            >
                                View all<span class="sr-only">
                                    {{ item.name }} stats</span
                                ></a
                            >
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup lang="ts">
import {
    ArrowSmallDownIcon,
    ArrowSmallUpIcon,
    MinusIcon,
} from "@heroicons/vue/24/solid";

export type Statistic = {
    id: number;
    name: string;
    stat: number;
    icon: any;
    prefix?: string;
    change: number;
};

interface Props {
    stats: Statistic[];
}
const props = defineProps<Props>();
</script>
