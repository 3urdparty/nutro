<template>
    <Button
        @click="$inertia.visit(route('delivery-person.dashboard'))"
        class="bg-white p-3 rounded-full shadow-lg border border-slate-400 hover:border-slate-500 hover:bg-slate-50"
    >
        <ArrowLeftIcon class="w-5 h-5 text-slate-500" />
    </Button>
</template>

<script setup lang="ts">
import { ArrowLeftIcon } from "@heroicons/vue/24/solid";
</script>
