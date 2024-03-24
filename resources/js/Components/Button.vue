<template>
    <button
        @click="emit('click', $event)"
        class="outline h-fit text-center p-1"
    >
        <slot />
    </button>
</template>
<script setup lang="ts">
interface Emits {
    (event: "click", e: MouseEvent): void;
}

const emit = defineEmits<Emits>();
</script>
