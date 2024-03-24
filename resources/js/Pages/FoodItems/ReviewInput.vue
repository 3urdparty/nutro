<template>
    <div class="flex items-start space-x-2">
        <div class="flex-shrink-0">
            <img
                class="h-10 w-10 rounded-full p-2 mt-1 bg-blue-400 text-white font-medium"
                :src="user.profile_photo_path"
                alt="MY"
            />
        </div>
        <div class="flex-1">
            <form @submit.prevent="$emit('submit')" class="relative">
                <StarSelect v-model="rating" :readonly="false" class="mt-2" />
                <div
                    class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 mt-2"
                >
                    <input
                        v-model="title"
                        class="border-none focus:ring-0 text-lg placeholder:focus:text-slate-400 transition py-0 pt-2"
                        placeholder="Title..."
                    />
                    <label for="comment" class="sr-only">Add your Review</label>
                    <textarea
                        v-model="body"
                        rows="3"
                        name="comment"
                        id="comment"
                        class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm pt-0"
                        placeholder="Add your Review..."
                    />

                    <!-- Spacer element to match the height of the toolbar -->
                    <div class="py-2" aria-hidden="true">
                        <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                        <div class="py-px">
                            <div class="h-9" />
                        </div>
                    </div>
                </div>

                <div
                    class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between"
                >
                    <div class="flex items-center space-x-5">
                        <div class="flex items-center">
                            <button
                                type="button"
                                class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500"
                            >
                                <PaperClipIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                                <span class="sr-only">Attach a file</span>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <Listbox as="div" v-model="selected">
                                <ListboxLabel class="sr-only">
                                    Your mood
                                </ListboxLabel>
                                <div class="relative">
                                    <ListboxButton
                                        class="relative -m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500"
                                    >
                                        <span
                                            class="flex items-center justify-center"
                                        >
                                            <span
                                                v-if="selected.value === null"
                                            >
                                                <FaceSmileIcon
                                                    class="flex-shrink-0 h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <span class="sr-only">
                                                    Add your mood
                                                </span>
                                            </span>
                                            <span
                                                v-if="
                                                    !(selected.value === null)
                                                "
                                            >
                                                <div
                                                    :class="[
                                                        selected.bgColor,
                                                        'w-8 h-8 rounded-full flex items-center justify-center',
                                                    ]"
                                                >
                                                    <component
                                                        :is="selected.icon"
                                                        class="flex-shrink-0 h-5 w-5 text-white"
                                                        aria-hidden="true"
                                                    />
                                                </div>
                                                <span class="sr-only">{{
                                                    selected.name
                                                }}</span>
                                            </span>
                                        </span>
                                    </ListboxButton>

                                    <transition
                                        leave-active-class="transition ease-in duration-100"
                                        leave-from-class="opacity-100"
                                        leave-to-class="opacity-0"
                                    >
                                        <ListboxOptions
                                            class="absolute z-10 mt-1 -ml-6 w-60 bg-white shadow rounded-lg py-3 text-base ring-1 ring-black ring-opacity-5 focus:outline-none sm:ml-auto sm:w-64 sm:text-sm"
                                        >
                                            <ListboxOption
                                                as="template"
                                                v-for="mood in moods"
                                                :key="mood.value"
                                                :value="mood"
                                                v-slot="{ active }"
                                            >
                                                <li
                                                    :class="[
                                                        active
                                                            ? 'bg-gray-100'
                                                            : 'bg-white',
                                                        'cursor-default select-none relative py-2 px-3',
                                                    ]"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div
                                                            :class="[
                                                                mood.bgColor,
                                                                'w-8 h-8 rounded-full flex items-center justify-center',
                                                            ]"
                                                        >
                                                            <component
                                                                :is="mood.icon"
                                                                :class="[
                                                                    mood.iconColor,
                                                                    'flex-shrink-0 h-5 w-5',
                                                                ]"
                                                                aria-hidden="true"
                                                            />
                                                        </div>
                                                        <span
                                                            class="ml-3 block font-medium truncate"
                                                        >
                                                            {{ mood.name }}
                                                        </span>
                                                    </div>
                                                </li>
                                            </ListboxOption>
                                        </ListboxOptions>
                                    </transition>
                                </div>
                            </Listbox>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <Button
                            :disabled="props.disabled"
                            type="submit"
                            :class="{
                                'bg-blue-500': !props.disabled,
                                'bg-gray-300': props.disabled,
                            }"
                            class="inline-flex bg-blue-500 rounded-md px-3 py-2 text-white"
                        >
                            Post
                        </Button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import Button from "@/Components/Button.vue";
import StarSelect from "@/Components/StarSelect.vue";
import { useUser } from "@/Composables/user";
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import {
    FaceFrownIcon,
    FaceSmileIcon,
    FireIcon,
    HeartIcon,
    PaperClipIcon,
} from "@heroicons/vue/24/solid";
import { useVModels } from "@vueuse/core";
import { ref } from "vue";

const moods = [
    {
        name: "Love it",
        value: "excited",
        icon: FireIcon,
        iconColor: "text-white",
        bgColor: "bg-red-500",
    },
    {
        name: "Liked it",
        value: "loved",
        icon: HeartIcon,
        iconColor: "text-white",
        bgColor: "bg-pink-400",
    },
    {
        name: "Satisfied",
        value: "happy",
        icon: FaceSmileIcon,
        iconColor: "text-white",
        bgColor: "bg-green-400",
    },
    {
        name: "Unsatisfied",
        value: "sad",
        icon: FaceFrownIcon,
        iconColor: "text-white",
        bgColor: "bg-yellow-400",
    },
];

const { user } = useUser();
const selected = ref(moods[2]);

interface Props {
    rating: number;
    title: string;
    body: string;
    disabled: boolean;
}
interface Emits {
    (event: "update:rating", value: number): boolean;
    (event: "update:title", value: string): boolean;
    (event: "update:body", value: string): boolean;
    (event: "submit"): boolean;
}
const props = withDefaults(defineProps<Props>(), {
    rating: 0,
    title: "",
    body: "",
});
const emit = defineEmits<Emits>();
const { rating, title, body } = useVModels(props, emit);
</script>
