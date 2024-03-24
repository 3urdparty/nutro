<template>
    <Listbox v-model="selected" as="div" v-slot="{ open }" class="relative">
        <slot name="button" :selected="selected">
            <ListboxButton
                class="relative w-full rounded-md border bg-white border-slate-300 py-2 pl-3 pr-10 text-left shadow-sm focus:outline-none focus-visible:border-blue-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm cursor-pointer hover:bg-slate-50 hover:text-blue-800 focus:ring-2 focus:ring-offset-2 ring-offset-blue-600 ring-white transition group"
            >
                <slot name="selected" :selected="selected">
                    <span v-if="typeof icon === 'string'" v-html="icon" />
                    <span
                        class="block truncate capitalize font-medium text-slate-500"
                        :class="{
                            'text-slate-300 group-focus:text-slate-200':
                                !selected,
                            'text-slate-300': selected,
                            'text-slate-200': open && !selected,
                        }"
                        >{{
                            (selected as I).name ??
                            selected ??
                            placeholder ??
                            "Select"
                        }}</span
                    >
                </slot>
                <span
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <ChevronUpDownIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </span>
            </ListboxButton>
        </slot>
        <transition name="slide">
            <ListboxOptions
                class="mt-2 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm absolute z-40"
            >
                <ListboxOption
                    v-slot="{ active, selected }"
                    v-for="(item, idx) in items"
                    :key="idx"
                    :value="(item as I).value ?? item"
                    as="div"
                >
                    <slot name="option" :item="item">
                        <li
                            :class="[
                                active
                                    ? 'bg-blue-200 text-blue-900'
                                    : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-4 pr-4  group flex items-center gap-2',
                            ]"
                        >
                            <!-- Icon -->
                            <div v-if="(item as I).icon" class="w-4 h-4">
                                <span
                                    v-if="  typeof((item as
                            I).icon)=='string'"
                                    class="text-blue-400"
                                    v-html="(item as I).icon"
                                />
                                <span v-else> component icon</span>
                            </div>
                            <span
                                :class="[
                                    selected ? 'font-medium' : 'font-normal',
                                    'block truncate capitalize text-blue-500 group-hover:text-blue-600',
                                ]"
                                >{{ (item as I).name ?? item }}
                            </span>
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 right-0 flex items-center pr-3"
                            >
                                <CheckIcon
                                    class="h-5 w-5 text-blue-400"
                                    aria-hidden="true"
                                />
                            </span>
                        </li>
                    </slot>
                </ListboxOption>
            </ListboxOptions>
        </transition>
    </Listbox>
</template>
<script setup lang="ts" generic="I extends MenuItem">
import { icon } from "@fortawesome/fontawesome-svg-core";
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon } from "@heroicons/vue/20/solid";
import { ChevronUpDownIcon } from "@heroicons/vue/24/solid";

import { useVModel } from "@vueuse/core";

export type MenuItem = {
    id?: number | string;
    icon?: string;
    name: string;
    value: string;
};

interface Props {
    modelValue: I | String;
    items: I[] | String[];
    placeholder?: String;
}
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
});

interface Emits {
    (event: "update:modelValue", value: I | String): void;
}
const emits = defineEmits<Emits>();
const selected = useVModel(props, "modelValue", emits);
</script>

<style scoped>
.slide-enter-active {
    transition: all 0.2s;
}
.slide-enter-from {
    opacity: 0;
    max-height: 0px;
}
.slide-enter-to {
    opacity: 1;
    max-height: 140px;
}
.slide-leave-active {
    transition: all 0.3s;
}
.slide-leave-from {
    opacity: 1;
    max-height: 140px;
}
.slide-leave-to {
    opacity: 0;
    max-height: 0px;
}
</style>
