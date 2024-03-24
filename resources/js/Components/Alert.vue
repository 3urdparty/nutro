<script setup lang="ts">
import { ExclamationCircleIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
interface Props {
    banner: string;
    link?: string;
    linkHref?: string;
    delay?: number;
    severity?: string;
}
const props = defineProps<Props>()

const styles = {
    danger: {
        border: "border-red-500 bg-red-50",
        button:"text-red-500 hover:bg-red-100 focus:ring-offset-red-50 focus:ring-red-600 bg-red-50",
        icon:"text-red-400",
        banner:"text-red-700",
        link:"text-red-700 hover:text-red-600"
    },
    success: {
        border: "border-green-500  bg-green-50",
        button:"text-green-500 hover:bg-green-100 focus:ring-offset-green-50 focus:ring-green-600 bg-green-50",
        icon:"text-green-400",
        banner:"text-green-700",
        link:"text-green-700 hover:text-green-600"
    },
    warning: {
        border: "border-blue-500  bg-blue-50",
        button:"text-blue-500 hover:bg-blue-100 focus:ring-offset-blue-50 focus:ring-blue-600 bg-red-50",
        icon:"text-blue-400",
        banner:"text-blue-700",
        link:"text-blue-700 hover:text-blue-600"
    },
    info: {
        border: "border-blue-500  bg-blue-50",
        button:"text-blue-500 hover:bg-blue-100 focus:ring-offset-blue-50 focus:ring-blue-600 bg-blue-50",
        icon:"text-blue-400",
        banner:"text-blue-700",
        link:"text-blue-700 hover:text-blue-600"
    },
};
const currentStyle = ref(styles[props.severity || "info"]);
interface Emits {
    (e: "close"): void;
}
const emits = defineEmits<Emits>();
</script>
<template>
        <div
            class=" border-l-4 p-3 w-full"
            :class="currentStyle.border"
        >
    
            <div class="flex justify-between">
                
                <div class="flex">
    
                    <div class="flex-shrink-0">
                        <ExclamationCircleIcon
                            class="h-5 w-5 "
                            :class="currentStyle.icon"
                            aria-hidden="true"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm"
                        :class="currentStyle.banner">
                            {{ banner }}
        
        
                <p class="mt-1 text-sm md:mt-0 ">
                    <Link
                                v-if="link && linkHref"
                                :href="linkHref"
        
                             class="whitespace-nowrap font-medium "
                             :class="currentStyle.link">
                             {{ link }} <span aria-hidden="true">&rarr;</span>
                                
                            </Link>
                </p>
                        </p>
                    </div>
                </div>
                <button type="button" class="h-6 w-6  rounded-md   focus:outline-none focus:ring-2 focus:ring-offset-2 flex items-center justify-center "
                @click="$emit('close')"
                :class="currentStyle.button">
                <span class="sr-only">Dismiss</span>
                <XMarkIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
            
                <slot name="actions">
                 </slot>
    
        </div>
</template>
