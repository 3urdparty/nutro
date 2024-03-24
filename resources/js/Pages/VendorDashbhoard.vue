<template>
    <AppLayout>
        <main class="flex-1"></main>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";

interface Props {
    deliveries: App.Models.Delivery[];
}

const props = defineProps<Props>();
</script>
