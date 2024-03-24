<script setup lang="ts">
interface Props {
    recipe: Object;
}
const props = defineProps<Props>();
</script>
<template>{{ props.recipe }}</template>
