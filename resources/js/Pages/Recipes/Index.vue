<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
<template>
    <AppLayout>
        <div class="p-10">
            <h1 class="text-3xl font-bold">Recipes</h1>
            <p class="text-slate-400">All the recipes on offer on Nutro</p>
            <ul
                role="list"
                class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-8"
            ></ul>
        </div>
    </AppLayout>
</template>
