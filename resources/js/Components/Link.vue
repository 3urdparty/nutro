<template>
    <Button @click="$inertia.visit(href)">
        <slot />
    </Button>
</template>
<script setup lang="ts">
interface Props {
    href: string;
    as?: string;
    method?: string;
    data?: any;

    only?: string[];
    replace?: boolean;
    preserveQuery?: boolean;
    preserveHash?: boolean;

    preserveScroll?: boolean;
}
const props = defineProps<Props>();
</script>
