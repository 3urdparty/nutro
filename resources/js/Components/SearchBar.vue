<script setup lang="ts" generic="O extends OptionItem, Q extends Query">
export interface OptionItem {
    name: string;
    unavailable: boolean;
}
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { ChevronDownIcon, MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
import { useVModel } from "@vueuse/core";
export type Query = {
    search: string | string[];
    type: string;
    section: string;
};
interface Props {
    modelValue: Q;
    placeholder: string;
    options: Array<any>;
}
interface Emits {
    (e: "update:modelValue", value: string): boolean;
}
const emits = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    placeholder: "Search",
    options: () => [],
});

const query = useVModel(props, "modelValue", emits);
</script>

<template>
    <div class="max-w-lg w-full lg:max-w-xs">
        <label for="search" class="sr-only">Search</label>

        <form
            :action="route('products.index')"
            method="GET"
            @submit.prevent="
                if (query.search)
                    $inertia.visit(route('products.index', query as any));
            "
            class="flex text-gray-400 focus-within:text-gray-600 h-full"
        >
            <Listbox
                as="div"
                class="left-0 h-full relative hidden md:inline-flex"
                v-model="query.type"
            >
                <ListboxButton
                    class="px-2 pl-3 rounded-l-md border-0 border-r border-gray-300 bg-gray-50 text-gray-500 sm:text-sm h-full font-medium items-center gap-1 md:inline-flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-500 focus: focus:ring-white focus:border-white transition min-w-[5rem] flex justify-between"
                    >{{ query.type ?? "Type" }}
                    <ChevronDownIcon class="h-4 w-4" aria-hidden="true"
                /></ListboxButton>
                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm absolute"
                    >
                        <ListboxOption
                            v-for="option in options"
                            :key="option.id"
                            :value="option.name"
                            as="template"
                            :disabled="option.unavailable"
                            v-slot="{ active, selected }"
                        >
                            <li
                                :class="[
                                    active
                                        ? 'bg-blue-100 text-blue-900'
                                        : 'text-gray-900',
                                    selected
                                        ? 'bg-blue-400 text-white hover:opacity-80'
                                        : 'font-normal',
                                    'relative cursor-default select-none py-2 pl-2 pr-4',
                                ]"
                            >
                                <span
                                    :class="[
                                        selected
                                            ? 'font-medium'
                                            : 'font-normal',
                                        'block truncate',
                                    ]"
                                    >{{ option.name }}</span
                                >
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </Listbox>

            <input
                id="search"
                class="rounded-l-md md:rounded-none block w-full bg-white py-2 pr-3 border border-transparent leading-5 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-500 focus:ring-white focus:border-white sm:text-sm font-poppins transition focus:z-40"
                :placeholder="placeholder ?? 'Search'"
                v-model="query.search"
            />

            <Button
                class="inline-flex h-full items-center px-3 rounded-r-md border-0 border-l border-blue-200 bg-blue-100 text-blue-500 sm:text-sm right-0 top-0"
            >
                <MagnifyingGlassIcon class="w-5" />
            </Button>
        </form>
    </div>
</template>
