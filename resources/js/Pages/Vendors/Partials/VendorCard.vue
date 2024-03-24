<template>
    <div
        class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200 border border-slate-300"
    >
        <div class="flex-1 flex flex-col p-8">
            <img
                class="w-32 h-32 flex-shrink-0 mx-auto rounded-full"
                :src="vendor.logo_url"
                alt=""
            />
            <h3
                class="mt-6 text-gray-900 font-semibold text-lg whitespace-nowrap truncate"
            >
                {{ vendor.name }}
            </h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
                <dt class="sr-only">Title</dt>
                <dd class="text-gray-500 text-sm line-clamp-3">
                    {{ vendor.description }}
                </dd>
                <dt class="sr-only">Role</dt>
                <dd class="mt-3">
                    <span
                        class="px-2 py-1 text-xs font-medium rounded-full whitespace-nowrap"
                        :class="
                            vendor.is_open
                                ? 'bg-green-100 text-green-800'
                                : 'bg-red-100 text-red-800'
                        "
                        >{{ vendor.is_open ? "Open" : "Closed" }} -
                        {{ vendor.open_time }}:00 to
                        {{ vendor.close_time }}:00</span
                    >
                </dd>
            </dl>
        </div>
        <Link
            :href="route('vendors.show', { vendor: vendor.slug })"
            class="py-3 bg-blue-500 text-white font-medium shadow font-sora flex items-center gap-2 justify-center px-1"
            >View Products

            <svg
                class="w-4"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 448 512"
            >
                <path
                    d="M448 96c0-35.3-28.7-64-64-64c-6.6 0-13 1-19 2.9c-22.5 7-48.1 14.9-71 9c-75.2-19.1-156.4 11-213.7 68.3S-7.2 250.8 11.9 326c5.8 22.9-2 48.4-9 71C1 403 0 409.4 0 416c0 35.3 28.7 64 64 64c6.6 0 13-1 19.1-2.9c22.5-7 48.1-14.9 71-9c75.2 19.1 156.4-11 213.7-68.3s87.5-138.5 68.3-213.7c-5.8-22.9 2-48.4 9-71c1.9-6 2.9-12.4 2.9-19.1zM212.5 127.4c-54.6 16-101.1 62.5-117.1 117.1C92.9 253 84 257.8 75.5 255.4S62.2 244 64.6 235.5c19.1-65.1 73.7-119.8 138.9-138.9c8.5-2.5 17.4 2.4 19.9 10.9s-2.4 17.4-10.9 19.9z"
                />
            </svg>
        </Link>
        <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="w-0 flex-1 flex">
                    <a
                        :href="`mailto:${vendor.email}`"
                        class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 er:bg-slate-50 hover:border-slate-200"
                    >
                        <EnvelopeIcon
                            class="w-5 h-5 text-gray-400"
                            aria-hidden="true"
                        />
                        <span class="ml-3">Email</span>
                    </a>
                </div>
                <div class="-ml-px w-0 flex-1 flex">
                    <a
                        :href="`tel:${vendor.phone_number}`"
                        class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 hover:bg-slate-50 hover:border-slate-200"
                    >
                        <PhoneIcon
                            class="w-5 h-5 text-gray-400"
                            aria-hidden="true"
                        />
                        <span class="ml-3">Call</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { EnvelopeIcon, PhoneIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/inertia-vue3";
interface Props {
    vendor: App.Models.Vendor;
}
const props = defineProps<Props>();
</script>
