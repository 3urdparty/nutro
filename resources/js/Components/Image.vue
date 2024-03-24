<script setup lang="ts">
import { UseImage } from "@vueuse/components/index.cjs";
interface Props {
    src: string;
}
const props = defineProps<Props>();
// const { isLoading, error, isReady } = useImage({ src: props.src });
</script>
<template>
    <UseImage :src="src">
        <template #loading>
            <div
                class="bg-blue-50 h-full w-full flex justify-center items-center animate-pulse"
            >
                <svg
                    class="w-8 animate-spin text-blue-500"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                >
                    <path
                        d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"
                        class="spinner_P7sC"
                    />
                </svg>
            </div>
        </template>

        <template #error>
            <slot name="error">
                <div
                    class="w-full flex items-center justify-center group-hover:opacity-40 transition-opacity duration-300 aspect-square"
                >
                    <svg
                        class="mx-auto h-12 w-12 text-gray-400"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 48 48"
                        aria-hidden="true"
                    >
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
            </slot>
        </template>
    </UseImage>
</template>
