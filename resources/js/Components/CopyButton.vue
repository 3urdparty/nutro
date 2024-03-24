<template>
    <div class="relative overflow-visible">
        <div
            class="absolute top-0 -mt-7 left-0 w-full flex justify-center items-center overflow-visible"
        >
            <transition
                enterActiveClass="transition duration-300 ease-in-out"
                enterToClass="opacity-100 scale-100"
                enterFromClass="opacity-0 scale-95"
                leaveActiveClass="transition duration-300 ease-in-out"
                leaveToClass="opacity-0 scale-95"
                leaveFromClass="opacity-100 scale-100"
            >
                <div
                    v-if="showTooltip"
                    class="bg-gray-800/60 rounded-md text-xs p-1 px-2 text-white select-none pointer-events-none"
                >
                    Copied!
                </div>
            </transition>
        </div>
        <button class="p-1 w-[1.3rem] group" @click="onClick">
            <svg
                class="w-full text-slate-400 group-hover:text-slate-600 transition"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
                fill="currentColor"
            >
                <path
                    d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"
                />
            </svg>
        </button>
    </div>
</template>

<script setup lang="ts">
import { useClipboard } from "@vueuse/core";
import { ref } from "vue";
interface Props {
    text: string;
}

const props = withDefaults(defineProps<Props>(), {
    text: "",
});
const { copy, copied, isSupported } = useClipboard();
const showTooltip = ref(false);
const onClick = (e: MouseEvent) => {
    showTooltip.value = true;
    copy(props.text);
    setTimeout(() => {
        showTooltip.value = false;
    }, 3000);
};
</script>
