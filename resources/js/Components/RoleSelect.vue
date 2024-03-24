<template>
    <MenuSelect :items="accountTypes" v-model="role">
        <template #button="{ selected }">
            <ListboxButton
                class="relative w-full bg-blue-50 rounded-md py-2 pl-3 pr-10 text-left shadow-sm focus:outline-none focus-visible:border-blue-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm cursor-pointer hover:bg-blue-200 hover:text-blue-800 focus:ring-2 focus:ring-offset-2 ring-offset-blue-600 ring-white transition"
            >
                <div
                    class="flex gap-2 justify-between capitalize text-blue-500"
                >
                    <div class="flex gap-2">
                        <svg
                            v-if="selected === 'customer'"
                            xmlns="http://www.w3.org/2000/svg"
                            height="16"
                            width="14"
                            viewBox="0 0 448 512"
                            fill="currentColor"
                        >
                            <path
                                d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"
                            />
                        </svg>
                        <svg
                            v-if="selected === 'vendor'"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 640 512"
                            height="16"
                            width="20"
                        >
                            <path
                                d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"
                            />
                        </svg>
                        <svg
                            v-if="selected === 'delivery-person'"
                            xmlns="http://www.w3.org/2000/svg"
                            height="16"
                            width="20"
                            fill="currentColor"
                            viewBox="0 0 640 512"
                        >
                            <path
                                d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                            />
                        </svg>
                        {{ selected }}
                    </div>
                </div>
                <span
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <ChevronUpDownIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </span>
            </ListboxButton>
        </template>
        <template #option="{ item }">
            <Link
                :href="route('switch-role', item)"
                method="get"
                class="p-2 px-3 flex gap-2 capitalize hover:bg-blue-200 w-full hover:text-blue-700 text-blue-500 justify-between"
                :class="{
                    'bg-blue-200 text-blue-700': item === role,
                }"
            >
                <div class="flex gap-2">
                    <svg
                        v-if="item === 'customer'"
                        xmlns="http://www.w3.org/2000/svg"
                        height="16"
                        width="14"
                        viewBox="0 0 448 512"
                        fill="currentColor"
                    >
                        <path
                            d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"
                        />
                    </svg>
                    <svg
                        v-if="item === 'vendor'"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 640 512"
                        height="16"
                        width="20"
                    >
                        <path
                            d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"
                        />
                    </svg>
                    <svg
                        v-if="item === 'delivery-person'"
                        xmlns="http://www.w3.org/2000/svg"
                        height="16"
                        width="20"
                        fill="currentColor"
                        viewBox="0 0 640 512"
                    >
                        <path
                            d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                        />
                    </svg>
                    {{ item }}
                </div>
                <CheckIcon
                    v-if="item === role"
                    class="h-5 w-5 text-blue-500"
                    aria-hidden="true"
                />
            </Link>
        </template>
    </MenuSelect>
</template>
<script setup lang="ts">
import { useUser } from "@/Composables/user";
import { ListboxButton } from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import MenuSelect from "./MenuSelect.vue";
const accountTypes = ["customer", "vendor", "delivery-person"];

const { role } = useUser();
</script>
