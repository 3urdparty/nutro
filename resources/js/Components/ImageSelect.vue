<template>
    <div
        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md h-full w-full items-center"
    >
        <div class="space-y-1 text-center">
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
            <div class="flex justify-center text-sm text-gray-600">
                <label
                    :for="id"
                    class="relative text cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                >
                    <span class="text-center w-full"
                        >Upload<span v-if="!minimized"> a file</span></span
                    >
                    <input
                        :id="id"
                        :name="id"
                        type="file"
                        class="sr-only"
                        @change="
                            $emit(
                                'update:modelValue',
                                ($event.target as HTMLInputElement).files[0]
                            )
                        "
                    />
                </label>
                <p class="pl-1" v-if="!minimized">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
        </div>
    </div>
</template>
<script setup lang="ts">
interface Props {
    minimized?: boolean;
    modelValue: File | string;
    id?: string;
}
interface Emits {
    (e: "update:modelValue", value: File): void;
}
const emits = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    minimized: false,
    id: "file-upload",
});
</script>
