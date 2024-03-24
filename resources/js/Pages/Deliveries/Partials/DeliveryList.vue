<template>
    <div class="mt-8">
        <div
            class="align-middle inline-block min-w-full border-b border-gray-200"
        >
            <table class="min-w-full">
                <thead>
                    <tr class="border-t border-gray-200">
                        <th
                            class="pl-3 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:block"
                        >
                            <span class="pl-2 flex items-center gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="16"
                                    width="14"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"
                                    />
                                </svg>
                                Order</span
                            >
                        </th>

                        <th
                            class="hidden lg:table-cell pl-3 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            <span class="pl-2 flex gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="16"
                                    width="14"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"
                                    />
                                </svg>
                                Customer</span
                            >
                        </th>
                        <th
                            class="hidden md:table-cell pl-3 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            <span class="pl-2 flex gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="16"
                                    width="18"
                                    viewBox="0 0 576 512"
                                >
                                    <path
                                        d="M384 476.1L192 421.2V35.9L384 90.8V476.1zm32-1.2V88.4L543.1 37.5c15.8-6.3 32.9 5.3 32.9 22.3V394.6c0 9.8-6 18.6-15.1 22.3L416 474.8zM15.1 95.1L160 37.2V423.6L32.9 474.5C17.1 480.8 0 469.2 0 452.2V117.4c0-9.8 6-18.6 15.1-22.3z"
                                    />
                                </svg>
                                Map</span
                            >
                        </th>
                        <th
                            class="pl-3 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            <span class="pl-2 flex gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="16"
                                    width="18"
                                    viewBox="0 0 576 512"
                                >
                                    <path
                                        d="M256 32H181.2c-27.1 0-51.3 17.1-60.3 42.6L3.1 407.2C1.1 413 0 419.2 0 425.4C0 455.5 24.5 480 54.6 480H256V416c0-17.7 14.3-32 32-32s32 14.3 32 32v64H521.4c30.2 0 54.6-24.5 54.6-54.6c0-6.2-1.1-12.4-3.1-18.2L455.1 74.6C446 49.1 421.9 32 394.8 32H320V96c0 17.7-14.3 32-32 32s-32-14.3-32-32V32zm64 192v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32s32 14.3 32 32z"
                                    />
                                </svg>
                                Distance</span
                            >
                        </th>

                        <th
                            class="pl-3 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            <span class="pl-2"></span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    <TransitionGroup
                        leave-active-class="transition ease-in duration-100"
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <DeliveryTableItem
                            :delivery="delivery"
                            v-for="(delivery, idx) in deliveries"
                            :canAccept="canAccept"
                            :key="idx"
                        />
                    </TransitionGroup>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup lang="ts">
import DeliveryTableItem from "./DeliveryTableItem.vue";

interface Props {
    deliveries: App.Models.Delivery[];
    canAccept?: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    deliveries: () => [],
    canAccept: false,
});
</script>
