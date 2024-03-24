<script setup>
import SectionTitle from "./SectionTitle.vue";
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <h1 class="text-blue-600 font-semibold">
                    <slot name="title" />
                </h1>
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div
                class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg border"
            >
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
