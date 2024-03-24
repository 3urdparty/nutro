<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import { ShoppingCartIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
interface Props {
    notifications: App.Models.Notification[];
}
const props = withDefaults(defineProps<Props>(), {
    notifications: () => [],
});

const tabs = [
    {
        name: "All",
        count: 0,
    },
    {
        name: "Inbox",
        count: 10,
    },
    {
        name: "Deals",
        count: 5,
    },
    {
        name: "Archived",
        count: 0,
    },
];
</script>
<template>
    <AppLayout>
        <div class="p-10">
            <h1 class="text-3xl font-bold">Notification</h1>
            <p class="text-slate-400">Find your notifications here</p>

            <TabGroup>
                <TabList class="border-b">
                    <Tab
                        v-for="tab in tabs"
                        class="font-medium mr-4 focus:outline-none focus:ring-0"
                        v-slot="{ selected }"
                    >
                        <div
                            class="flex items-center gap-2"
                            :class="{
                                'text-blue-600 border-b-4  border-blue-600 transition':
                                    selected,
                                'text-slate-600': !selected,
                            }"
                        >
                            {{ tab.name }}
                            <span
                                v-if="tab.count > 0"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 text-sm"
                            >
                                {{ tab.count }}
                            </span>
                        </div>
                    </Tab>
                </TabList>
                <TabPanels>
                    <TabPanel>
                        <ul>
                            <li v-for="notification in notifications">
                                <Link :href="notification.data.url">
                                    <div
                                        class="flex items-center gap-3 px-2 py-4 hover:bg-slate-100 transition"
                                    >
                                        <span
                                            class="bg-blue-500 rounded-full w-3 h-3"
                                        />
                                        <div class="relative">
                                            <img
                                                src=""
                                                alt=""
                                                class="w-12 h-12 rounded-full bg-slate-200 p-1"
                                            />

                                            <span
                                                class="bg-red-400 w-7 h-7 absolute bottom-0 -right-2 rounded-full p-1.5"
                                            >
                                                <ShoppingCartIcon
                                                    v-if="
                                                        notification.type ===
                                                        'App\\Notifications\\OrderCreatedNotification'
                                                    "
                                                    class="text-white"
                                                />
                                            </span>
                                        </div>

                                        <div>
                                            <p class="space-x-1">
                                                <span class="font-semibold">
                                                    {{
                                                        notification.data.name
                                                    }}</span
                                                >

                                                <span
                                                    class="text-slate-400"
                                                    v-html="
                                                        notification.data
                                                            .message
                                                    "
                                                ></span>
                                            </p>
                                            <p class="text-sm ml-1">
                                                <span
                                                    class="font-medium text-slate-500"
                                                >
                                                    Yesterday
                                                </span>
                                                &middot;
                                                <span> 🚚 Delivery </span>
                                            </p>
                                        </div>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </TabPanel>
                    <TabPanel>Content 2</TabPanel>
                    <TabPanel>Content 3</TabPanel>
                </TabPanels>
            </TabGroup>
        </div>
    </AppLayout>
</template>
