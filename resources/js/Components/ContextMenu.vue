<template>
    <div class="z-[100]">
        <div class="rounded w-40 border border-slate-300 bg-white shadow py-1">
            <slot name="body">
                <div class="divide-y">
                    <button
                        @click="option.action"
                        v-for="option in options"
                        class="text-slate-600 text-sm font-medium py-1 font-sora text-md bg-white text-md w-full text-start px-2 transition flex gap-1 pb-1.5 items-center"
                        :class="{
                            'hover:text-blue-500 hover:bg-blue-200 active:bg-blue-400':
                                !option.severity || option.severity === 'info',
                            'hover:text-red-500 hover:bg-red-200 active:bg-red-400':
                                option.severity === 'danger',
                        }"
                    >
                        <component
                            :is="option.icon"
                            class="w-4 mb-0.5 mr-0.5"
                            :class="{
                                'text-red-400': option.severity === 'danger',
                            }"
                            v-if="option.icon"
                        />
                        {{ option.label }}
                    </button>
                </div>
            </slot>
        </div>
    </div>
</template>
<script setup lang="ts">
import { useContextMenu } from "@/Composables/contextmenu";

interface Props {}

const { options } = useContextMenu();
</script>
