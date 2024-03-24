// store.js
import type { Flash, SocialstreamPageProps } from "@/Types/Laravel";
import { usePage } from "@inertiajs/inertia-vue3";
import { createGlobalState } from "@vueuse/core";
import { ref, watch } from "vue";

export const useFlash = createGlobalState(() => {
    const page = usePage<SocialstreamPageProps>();
    const queue = ref<Flash[]>([]);
    const addToQueue = (flash: Flash[] | Flash) => {
        if (!Array.isArray(flash)) flash = [flash];
        flash.forEach((f) => {
            queue.value.push(f);
            setTimeout(() => {
                removeFromQueue(queue.value.indexOf(f));
            }, 10000);
        });
    };
    watch(
        page.props,
        (newProps) => {
            console.log(page.props.value.jetstream.flash);
            console.log(newProps);
            if (page.props.value.jetstream.flash)
                addToQueue(page.props.value.jetstream.flash);
        },
        { immediate: true }
    );

    const removeFromQueue = (idx: number) => {
        queue.value.splice(idx, 1);
    };

    return { queue, addToQueue, removeFromQueue };
});
