<template>
    <div>
        <CustomerTag />
        <ItemsOverview :items="props.order.items" />
    </div>
</template>
<script setup lang="ts">
import CustomerTag from "@/Components/CustomerTag.vue";
import ItemsOverview from "@/Components/ItemsOverview.vue";
interface Props {
    order: App.Models.Order;
}
const props = defineProps<Props>();
</script>
