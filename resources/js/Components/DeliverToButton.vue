<script setup lang="ts">
import { MapPinIcon } from "@heroicons/vue/24/solid";
</script>
<template>
    <Button
        class="bg-white/30 p-1 px-2 border border-white rounded-md text-white text-left flex items-center gap-2 hover:opacity-80 active:bg-blue-600"
    >
        <MapPinIcon class="h-6 w-6 text-white" aria-hidden="true" />
        <div>
            <div class="text-xs font-poppins font-medium leading-4">
                Deliver to
            </div>
            <div class="font-bold text-sm">Cyberjaya</div>
        </div>
    </Button>
</template>
