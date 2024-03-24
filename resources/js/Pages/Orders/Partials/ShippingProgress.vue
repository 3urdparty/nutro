<script setup lang="ts">
import { computed } from "vue";

interface Props {
    status: "placed" | "prepared" | "collected" | "delivering" | "delivered";
}
const props = withDefaults(defineProps<Props>(), {
    status: "prepared",
});
const width = computed(() => {
    switch (props.status) {
        case "placed":
            return "1.5%";
        case "prepared":
        case "collected":
            return "35%";
        case "delivering":
            return "65%";
        case "delivered":
            return "100%";
    }
});
</script>
<template>
    <div>
        <div aria-hidden="true">
            <div class="bg-gray-200 rounded-full overflow-hidden">
                <div
                    class="h-1.5 bg-blue-600 rounded-full"
                    :style="{
                        width: width,
                    }"
                />
            </div>
            <div
                class="hidden sm:grid grid-cols-4 text-sm font-medium text-gray-600 mt-3"
            >
                <div
                    class="text-left flex gap-1.5 items-center whitespace-nowrap pl-5"
                    :class="
                        status === 'prepared'
                            ? 'text-blue-600'
                            : 'text-gray-800'
                    "
                >
                    <svg
                        class="w-3"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        fill="currentColor"
                    >
                        <path
                            d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"
                        />
                    </svg>
                    Prepared
                </div>
                <div
                    class="text-center flex gap-1.5 items-center whitespace-nowrap pl-5"
                    :class="
                        status === 'collected'
                            ? 'text-blue-600'
                            : 'text-gray-800'
                    "
                >
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512"
                        fill="currentColor"
                    >
                        <path
                            d="M640 0V400c0 61.9-50.1 112-112 112c-61 0-110.5-48.7-112-109.3L48.4 502.9c-17.1 4.6-34.6-5.4-39.3-22.5s5.4-34.6 22.5-39.3L352 353.8V64c0-35.3 28.7-64 64-64H640zM576 400a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM23.1 207.7c-4.6-17.1 5.6-34.6 22.6-39.2l46.4-12.4 20.7 77.3c2.3 8.5 11.1 13.6 19.6 11.3l30.9-8.3c8.5-2.3 13.6-11.1 11.3-19.6l-20.7-77.3 46.4-12.4c17.1-4.6 34.6 5.6 39.2 22.6l41.4 154.5c4.6 17.1-5.6 34.6-22.6 39.2L103.7 384.9c-17.1 4.6-34.6-5.6-39.2-22.6L23.1 207.7z"
                        />
                    </svg>
                    Collected
                </div>
                <div
                    class="text-center flex gap-1.5 items-center justify-center whitespace-nowrap"
                    :class="
                        status === 'delivering'
                            ? 'text-blue-600'
                            : 'text-gray-800'
                    "
                >
                    <svg
                        class="w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512"
                    >
                        <path
                            d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"
                        />
                    </svg>
                    Delivering
                </div>
                <div
                    class="text-right justify-end flex gap-1.5 items-center whitespace-nowrap"
                    :class="
                        status === 'delivered'
                            ? 'text-blue-600'
                            : 'text-gray-800'
                    "
                >
                    <svg
                        class="w-3"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        color="currentColor"
                    >
                        <path
                            d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM305 273L177 401c-9.4 9.4-24.6 9.4-33.9 0L79 337c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L271 239c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"
                        />
                    </svg>
                    Delivered
                </div>
            </div>
        </div>
    </div>
</template>
