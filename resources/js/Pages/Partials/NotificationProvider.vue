<script setup lang="ts">
import Alert from "@/Components/Alert.vue";
import ProductAlert from "@/Components/ProductAlert.vue";
import { useFlash } from "@/Composables/flash";

const { queue, removeFromQueue } = useFlash();
</script>
<template>
    <div class="bottom-0 z-[200] fixed shadow-xl w-full p-3">
        <div>
            <TransitionGroup name="slide-fade" class="flex flex-col">
                <template v-for="(flash, idx) in queue">
                    <ProductAlert
                        @close="removeFromQueue(idx)"
                        v-bind="flash"
                        v-if="flash.type === 'activity'"
                    />
                    <Alert
                        :key="idx"
                        v-bind="flash"
                        class="shadow-md z-[100]"
                        v-else-if="flash.type === 'flash'"
                        @close="removeFromQueue(idx)"
                    />
                </template>
            </TransitionGroup>
        </div>
    </div>
</template>
<style scoped>
.slide-fade-enter-active {
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from {
    transform: translateY(100px);
    opacity: 0;
}
.slide-fade-leave-to {
    transform: translateX(30rem);
    opacity: 0;
}
</style>
