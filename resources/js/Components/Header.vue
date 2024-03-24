<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="sticky -top-10 z-30 bg-slate-200">
        <Banner> Get free delivery on orders over RM20! </Banner>
        <PopoverGroup as="nav" class="bg-blue-500">
            <Popover class="relative" v-slot="{ open }">
                <div :class="{ 'shadow-md': open }">
                    <div class="max-w-10xl mx-auto px-2 sm:px-4 lg:px-5 pt-2">
                        <div
                            class="relative pb-2 flex items-center justify-between lg:border-b lg:border-blue-400 lg:border-opacity-25 h-14"
                        >
                            <div class="px-2 flex items-center lg:px-0 gap-2">
                                <Link href="/" class="flex items-center gap-1">
                                    <div class="flex-shrink-0">
                                        <ApplicationLogo class="w-8 h-10" />
                                    </div>
                                    <span
                                        class="text-white font-semibold text-xl mt-0.5 hidden sm:block"
                                    >
                                        Nutro
                                    </span>
                                </Link>
                                <div class="hidden lg:block lg:ml-6">
                                    <div class="flex space-x-1">
                                        <TransitionGroup
                                            enter-active-class="transition ease-out duration-200"
                                            enter-from-class="opacity-0 translate-y-1"
                                            enter-to-class="opacity-100 translate-y-0"
                                            leave-active-class="transition ease-in duration-150"
                                        >
                                            <Link
                                                v-for="item in navigation.slice(
                                                    0,
                                                    3
                                                )"
                                                v-show="item.show"
                                                :key="item.name"
                                                :href="item.href"
                                                :class="[
                                                    isActive(item.href)
                                                        ? 'bg-blue-700 text-white hover:bg-blue-800'
                                                        : 'text-white  hover:bg-opacity-75 hover:bg-blue-600 active:bg-blue-700',
                                                    'rounded-md py-2 px-3 text-sm font-medium',
                                                ]"
                                            >
                                                {{ item.name }}
                                            </Link>
                                        </TransitionGroup>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-1 px-2 flex justify-center lg:ml-6 lg:justify-end gap-2"
                            >
                                <DeliverToButton class="hidden md:flex" />
                                <SearchBar
                                    :options="options"
                                    v-model="query"
                                    placeholder="Search Nutro.com"
                                    class="w-full"
                                />

                                <LanguageSelect class="hidden lg:block" />
                            </div>
                            <div class="flex lg:hidden">
                                <!-- Mobile menu button -->
                                <PopoverButton
                                    class="bg-blue-500 p-2 rounded-md inline-flex items-center justify-center text-blue-200 hover:text-white hover:bg-blue-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white"
                                >
                                    <span class="sr-only">Open main menu</span>
                                    <ListBulletIcon
                                        v-if="!open"
                                        class="block h-6 w-6"
                                        aria-hidden="true"
                                    />
                                    <XMarkIcon
                                        v-else
                                        class="block h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </PopoverButton>
                            </div>
                            <div class="hidden lg:block lg:ml-4">
                                <div class="flex items-center gap-2">
                                    <Button
                                        v-if="loggedIn"
                                        type="button"
                                        class="bg-blue-500 flex-shrink-0 rounded-full p-1 text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-700 focus:ring-white"
                                    >
                                        <span class="sr-only"
                                            >View notifications</span
                                        >
                                        <BellIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </Button>
                                    <Link
                                        :href="route('cartItems.index')"
                                        type="button"
                                        class="bg-blue-500 flex-shrink-0 rounded-full p-1 text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-700 focus:ring-white"
                                    >
                                        <span class="sr-only"
                                            >View notifications</span
                                        >
                                        <div
                                            class="w-6 h-6 relative"
                                            v-if="is('customer')"
                                        >
                                            <ShoppingBagIcon
                                                aria-hidden="true"
                                            />
                                            <span
                                                class="p-0.5 bg-blue-600 h-4 w-4 rounded-full absolute -top-2 -right-1 flex items-center justify-center text-xs"
                                                >1
                                            </span>
                                        </div>
                                    </Link>

                                    <ProfileDropDown
                                        :user="user"
                                        :navigation="[
                                            ...userNavigation,
                                            ...loggedInNavigation,
                                        ]"
                                        v-if="loggedIn"
                                    />
                                    <template v-else>
                                        <Link
                                            v-for="item in loggedOutNavigation"
                                            :href="item.href"
                                            type="button"
                                            class="bg-blue-300/50 h-full font-medium flex-shrink-0 rounded px-2 p-1 text-white hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-700 focus:ring-white border border-white"
                                        >
                                            {{ item.name }}
                                        </Link>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 "
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition ease-in duration-150"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 translate-y-1"
                    >
                        <PopoverPanel
                            class="lg:hidden absolute w-full bg-blue-500 rounded-b-md shadow-md pb-1 border-b-4 border-blue-600"
                        >
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <Link
                                    v-for="item in navigation"
                                    v-show="item.show"
                                    :key="item.name"
                                    as="a"
                                    :href="item.href"
                                    :class="[
                                        isActive(item.href)
                                            ? 'bg-blue-700 text-white hover:bg-blue-800'
                                            : 'text-white  hover:bg-opacity-75 hover:bg-blue-600 active:bg-blue-700',
                                        'flex gap-2 items-center rounded-md py-2 px-3 text-base font-medium',
                                    ]"
                                    :aria-current="
                                        isActive(item.href) ? 'page' : undefined
                                    "
                                >
                                    <span
                                        v-if="item.icon"
                                        v-html="item.icon"
                                        class="text-white h-5 w-4"
                                    ></span>
                                    {{ item.name }}
                                </Link>
                            </div>
                            <div class="pt-4 pb-3 border-t border-blue-700">
                                <div class="px-5 flex items-center" v-if="user">
                                    <div class="flex-shrink-0">
                                        <span class="inline-block relative">
                                            <span class="sr-only"
                                                >Open user menu</span
                                            >
                                            <Link :href="route('profile.show')">
                                                <img
                                                    class="h-8 w-8 rounded-full bg-blue-50 p-0.5 text-blue-400 text-md flex items-center justify-center font-medium"
                                                    :src="
                                                        user.profile_photo_path
                                                    "
                                                    :alt="
                                                        user.name
                                                            .charAt(0)
                                                            .toUpperCase()
                                                    "
                                                />
                                            </Link>
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div
                                            class="text-base font-medium text-white"
                                        >
                                            {{ user.name }}
                                        </div>
                                        <div
                                            class="text-sm font-medium text-blue-300"
                                        >
                                            {{ user.email }}
                                        </div>
                                    </div>
                                    <Link
                                        v-if="loggedIn"
                                        as="button"
                                        :href="route('notifications.index')"
                                        class="ml-auto bg-blue-500 flex-shrink-0 rounded-full p-1 text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white"
                                    >
                                        <span class="sr-only"
                                            >View notifications</span
                                        >
                                        <BellIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </Link>
                                </div>

                                <div class="px-3 mt-2" v-if="loggedIn">
                                    <RoleSelect />
                                </div>
                                <div class="mt-3 px-2 space-y-1">
                                    <Link
                                        v-for="item in userNavigation"
                                        v-show="item.show"
                                        :key="item.name"
                                        as="a"
                                        :href="item.href"
                                        :class="[
                                            isActive(item.href)
                                                ? 'bg-blue-700 text-white hover:bg-blue-800'
                                                : 'text-white  hover:bg-opacity-75 hover:bg-blue-600 active:bg-blue-700',
                                            'flex gap-2 items-center rounded-md py-2 px-3 text-base font-medium',
                                        ]"
                                        :aria-current="
                                            isActive(item.href)
                                                ? 'page'
                                                : undefined
                                        "
                                    >
                                        <component
                                            v-if="item.icon"
                                            :is="item.icon"
                                            class="text-white h-5 w-5"
                                        />
                                        {{ item.name }}
                                    </Link>

                                    <template v-if="loggedIn">
                                        <Link
                                            v-for="item in loggedInNavigation"
                                            :key="item.name"
                                            :method="(item.method as 'get' | 'post' )"
                                            :href="item.href"
                                            :class="[
                                                isActive(item.href)
                                                    ? 'bg-blue-700 text-white hover:bg-blue-800'
                                                    : 'text-white  hover:bg-opacity-75 hover:bg-blue-600 active:bg-blue-700',
                                                'flex gap-2 items-center rounded-md py-2 px-3 text-base font-medium',
                                            ]"
                                            :aria-current="
                                                isActive(item.href)
                                                    ? 'page'
                                                    : undefined
                                            "
                                        >
                                            <div
                                                v-if="item.icon"
                                                v-html="item.icon"
                                                class="text-white h-4 w-4 mb-0.5"
                                            />
                                            {{ item.name }}
                                        </Link>
                                    </template>
                                    <template v-else>
                                        <Link
                                            v-for="item in loggedOutNavigation"
                                            :key="item.name"
                                            :href="item.href"
                                            :class="[
                                                isActive(item.href)
                                                    ? 'bg-blue-700 text-white hover:bg-blue-800'
                                                    : 'text-white  hover:bg-opacity-75 hover:bg-blue-600 active:bg-blue-700',
                                                'flex gap-2 items-center rounded-md py-2 px-3 text-base font-medium',
                                            ]"
                                            :aria-current="
                                                isActive(item.href)
                                                    ? 'page'
                                                    : undefined
                                            "
                                        >
                                            <div
                                                v-if="item.icon"
                                                v-html="item.icon"
                                                class="text-white h-4 w-4 mb-0.5"
                                            />
                                            {{ item.name }}
                                        </Link>
                                    </template>
                                </div>
                            </div>
                        </PopoverPanel>
                    </transition>
                    <div class="hidden sm:block" v-if="is('customer')">
                        <div
                            class="w-full p-2 bg-blue-900 px-4 flex gap-3 text-sm"
                        >
                            <Button
                                @click="$inertia.visit(link.href)"
                                class="text-white rounded-sm px-1 flex items-center gap-2"
                                :class="[
                                    isActive(link.href) ? 'font-semibold' : '',
                                ]"
                                v-for="link in links"
                                :key="link.name"
                            >
                                <svg
                                    v-if="link.default"
                                    class="w-4"
                                    viewBox="0 0 47 34"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect width="47" height="6" fill="white" />
                                    <rect
                                        width="47"
                                        height="6"
                                        transform="translate(0 14)"
                                        fill="white"
                                    />
                                    <rect
                                        width="47"
                                        height="6"
                                        transform="translate(0 28)"
                                        fill="white"
                                    />
                                </svg>
                                {{ link.name }}
                            </Button>
                        </div>
                    </div>
                </div>
            </Popover>
        </PopoverGroup>
    </div>
</template>

<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import DeliverToButton from "@/Components/DeliverToButton.vue";
import RoleSelect from "@/Components/RoleSelect.vue";
import { useUser } from "@/Composables/user";
import {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from "@headlessui/vue";
import { BellIcon } from "@heroicons/vue/20/solid";

import {
    Cog6ToothIcon,
    ListBulletIcon,
    ShoppingBagIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";

import { usePage } from "@inertiajs/inertia-vue3";
import { useUrlSearchParams } from "@vueuse/core";
import { inject, reactive } from "vue";
import ApplicationLogo from "./ApplicationLogo.vue";
import LanguageSelect from "./LanguageSelect.vue";
import ProfileDropDown from "./ProfileDropDown.vue";
import SearchBar, { type OptionItem } from "./SearchBar.vue";
const { user, role, is, loggedIn } = useUser();

const navigation = [
    {
        name: "Home",
        href: route("home"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" fill="currentColor" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>',
        show: true,
    },
    {
        name: "Products",
        href: route("products.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M448 96c0-35.3-28.7-64-64-64c-6.6 0-13 1-19 2.9c-22.5 7-48.1 14.9-71 9c-75.2-19.1-156.4 11-213.7 68.3S-7.2 250.8 11.9 326c5.8 22.9-2 48.4-9 71C1 403 0 409.4 0 416c0 35.3 28.7 64 64 64c6.6 0 13-1 19.1-2.9c22.5-7 48.1-14.9 71-9c75.2 19.1 156.4-11 213.7-68.3s87.5-138.5 68.3-213.7c-5.8-22.9 2-48.4 9-71c1.9-6 2.9-12.4 2.9-19.1zM212.5 127.4c-54.6 16-101.1 62.5-117.1 117.1C92.9 253 84 257.8 75.5 255.4S62.2 244 64.6 235.5c19.1-65.1 73.7-119.8 138.9-138.9c8.5-2.5 17.4 2.4 19.9 10.9s-2.4 17.4-10.9 19.9z"/></svg>',

        show: is("customer") || !loggedIn.value,
    },
    {
        name: "Orders",
        href: route("orders.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"/></svg>',

        show: is("customer"),
    },
    {
        name: "Vendors",
        href: route("vendors.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"/></svg>',

        show: is("customer") || !loggedIn.value,
    },
    {
        name: "Deals",
        href: route("deals.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>',

        show: is("customer") || !loggedIn,
    },
    {
        name: "Deliveries",
        href: route("deliveries.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="20"  fill="currentColor" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>',

        show: is("customer"),
    },
    {
        name: "Recipes",
        href: route("recipes.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"  viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M0 80v48c0 17.7 14.3 32 32 32H48 96V80c0-26.5-21.5-48-48-48S0 53.5 0 80zM112 32c10 13.4 16 30 16 48V384c0 35.3 28.7 64 64 64s64-28.7 64-64v-5.3c0-32.4 26.3-58.7 58.7-58.7H480V128c0-53-43-96-96-96H112zM464 480c61.9 0 112-50.1 112-112c0-8.8-7.2-16-16-16H314.7c-14.7 0-26.7 11.9-26.7 26.7V384c0 53-43 96-96 96H368h96z"/></svg>',

        show: is("customer"),
    },

    {
        name: "Dashboard",
        href: route("delivery-person.dashboard"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>',
        show: is("delivery-person"),
    },
    {
        name: "Dashboard",
        href: route("vendor.dashboard"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>',
        show: is("vendor"),
    },

    {
        name: "Deliveries",
        href: route("deliveries.index"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"  viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>',

        show: is("delivery-person"),
    },
];
const userNavigation = [
    { name: "Settings", href: route("profile.show"), icon: Cog6ToothIcon },
    {
        name: "Cart",
        href: route("cartItems.index"),
        icon: ShoppingBagIcon,
        show: is("customer"),
    },
];
const loggedInNavigation = [
    {
        name: "Logout",
        href: route("logout"),
        method: "post",
        icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" ><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>',
    },
];

const loggedOutNavigation = [
    {
        name: "Login",
        href: route("login"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"  viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>',
    },
    {
        name: "Register",
        href: route("register"),
        icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>',
    },
];

const page = usePage();
const searchParams = useUrlSearchParams("history", {
    removeFalsyValues: true,
    removeNullishValues: true,
    write: true,
});
const query = reactive({
    search: searchParams.search,
    section: "",
    type: "Food",
});

const canLogin = inject("canLogin");
const canRegister = inject("canRegister");

const links = [
    { name: "All", value: "", default: true, href: route("home") + "/" },
    {
        name: "New Arrivals",
        href: route("products.index", { category: "new-arrivals" }),
    },
    {
        name: "Best Sellers",
        href: route("products.index", { category: "best-sellers" }),
    },
    {
        name: "Fresh Produce",
        href: route("products.index", { category: "fresh-produce" }),
    },
    {
        name: "Today's deals",
        href: route("products.index", { category: "todays-deals" }),
    },
];
const options: OptionItem[] = [
    { name: "Food", unavailable: false },
    { name: "Vendor", unavailable: false },
];

const isActive = (url: string) => {
    let current_path = page.url.value;
    let url_path = url.split(window.location.host).pop();
    if (current_path.endsWith("/")) current_path = current_path.slice(0, -1);
    if (url_path.endsWith("/")) url_path = url_path.slice(0, -1);

    return url_path == current_path;
};
// TODO: Add background to top and bottom of app
</script>
@/Composables/user
