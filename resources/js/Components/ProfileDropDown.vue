<template>
    <!-- Profile dropdown -->
    <Menu as="div" class="ml-3 relative flex-shrink-0">
        <div>
            <MenuButton
                class="bg-blue-500 rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white"
            >
                <span class="inline-block relative">
                    <img
                        class="h-6 w-6 rounded-full p-px bg-white/50"
                        :src="user.profile_photo_path"
                        alt=""
                    />
                    <span
                        class="absolute bottom-0 right-0 block h-1.5 w-1.5 rounded-full ring-2 ring-white bg-gray-300"
                    />
                </span>
            </MenuButton>
        </div>
        <transition
            enter-active-class="transition ease-in-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in-out duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <TransitionGroup
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                >
                    <MultiSelect
                        :items="roles"
                        v-model="role"
                        class="px-4 pt-3"
                    >
                        <template #option="{ item }">
                            <span
                                class="w-full h-full flex justify-between items-center"
                                :class="[
                                    role == item.value ? 'bg-blue-100' : '',
                                    'py-2 px-4 text-sm text-gray-700',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    class="w-4 h-4 text-blue-500 transition"
                                    :class="[
                                        role == item.value
                                            ? 'text-blue-500'
                                            : 'text-slate-400',
                                    ]"
                                />
                            </span>
                        </template>
                    </MultiSelect>
                    <MenuItem
                        class="mt-2"
                        v-for="item in navigation"
                        :key="item.name"
                        v-slot="{ active }"
                    >
                        <Link
                            :href="item.href"
                            :method="(item.method as 'post'|'get')"
                            :class="[
                                active ? 'bg-gray-100' : '',
                                'block py-2 px-4 text-sm text-gray-700',
                            ]"
                        >
                            <!-- <component v-if="item.icon" :is="item.icon" /> -->
                            <span class="flex gap-1">
                                {{ item.name }}
                            </span>
                        </Link>
                    </MenuItem>
                </TransitionGroup>
            </MenuItems>
        </transition>
    </Menu>
</template>
<script setup lang="ts">
import { useUser } from "@/Composables/user";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    BuildingStorefrontIcon,
    TruckIcon,
    UserIcon,
} from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import MultiSelect from "./MultiSelect.vue";
export type NavigationItem = {
    name: string;
    href: string;
    icon?: string | Object;
    method?: string;
    show?: boolean;
};
interface Props {
    navigation: Array<NavigationItem>;
    user: App.Models.User;
}
const roles = [
    {
        name: "Customer",
        value: "customer",
        icon: UserIcon,
    },

    {
        name: "Vendor",
        value: "vendor",
        icon: BuildingStorefrontIcon,
    },

    {
        name: "Delivery Person",
        value: "delivery-person",
        icon: TruckIcon,
    },
];
const { role } = useUser();

const props = defineProps<Props>();
</script>
