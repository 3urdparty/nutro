<template>
    <section
        aria-labelledby="timeline-title"
        class="lg:col-start-3 lg:col-span-1"
    >
        <div
            class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 border border-slate-300"
        >
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">
                Activity
            </h2>

            <!-- Activity Feed -->
            <div class="flow-root mt-6">
                <ul role="list" class="-mb-8">
                    <li v-for="(event, eventIdx) in timeline" :key="event.id">
                        <div class="relative pb-8">
                            <span
                                v-if="eventIdx !== timeline.length - 1"
                                class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                aria-hidden="true"
                            />
                            <div class="relative flex space-x-3">
                                <div>
                                    <span
                                        :class="[
                                            event.iconBackground,
                                            'h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white',
                                        ]"
                                    >
                                        <component
                                            :is="event.icon"
                                            class="h-5 w-5 text-white"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </div>
                                <div
                                    class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4"
                                >
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            {{ event.content }}
                                            <Link
                                                :href="event.href"
                                                class="font-medium text-gray-900"
                                                >{{ event.target }}</Link
                                            >
                                        </p>
                                    </div>
                                    <div
                                        class="text-right text-sm whitespace-nowrap text-gray-500"
                                    >
                                        <time :datetime="event.datetime">{{
                                            event.date
                                        }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mt-10 flex flex-col justify-stretch">
                <button
                    type="button"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Advance to offer
                </button>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { CheckIcon, HandThumbUpIcon, UserIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/inertia-vue3";
const timeline = [
    {
        id: 1,
        content: "Applied to",
        target: "Front End Developer",
        href: "#",
        date: "Sep 20",
        datetime: "2020-09-20",
        icon: UserIcon,
        iconBackground: "bg-gray-400",
    },
    {
        id: 2,
        content: "Advanced to phone screening by",
        target: "Bethany Blake",
        href: "#",
        date: "Sep 22",
        datetime: "2020-09-22",
        icon: HandThumbUpIcon,
        iconBackground: "bg-blue-500",
    },
    {
        id: 3,
        content: "Completed phone screening with",
        target: "Martha Gardner",
        href: "#",
        date: "Sep 28",
        datetime: "2020-09-28",
        icon: CheckIcon,
        iconBackground: "bg-green-500",
    },
    {
        id: 4,
        content: "Advanced to interview by",
        target: "Bethany Blake",
        href: "#",
        date: "Sep 30",
        datetime: "2020-09-30",
        icon: HandThumbUpIcon,
        iconBackground: "bg-blue-500",
    },
    {
        id: 5,
        content: "Completed interview with",
        target: "Katherine Snyder",
        href: "#",
        date: "Oct 4",
        datetime: "2020-10-04",
        icon: CheckIcon,
        iconBackground: "bg-green-500",
    },
];
</script>
