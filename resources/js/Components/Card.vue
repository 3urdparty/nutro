<template>
    <div
        class="bg-white overflow-hidden shadow rounded-lg border border-slate-300"
        :class="$attrs.class"
    >
        <slot>
            <div class="px-4 py-5 sm:px-6 border-b" v-if="$slots.header">
                <slot name="header" />
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:p-6 h-full">
                <slot name="content" />
            </div>
            <div v-if="$slots.header" class="px-4 py-5 sm:px-6 border-t">
                <slot name="footer"> </slot>
            </div>
        </slot>
    </div>
</template>
