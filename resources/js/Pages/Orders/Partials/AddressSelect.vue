<template>
    <RadioGroup v-model="selected">
        <RadioGroupLabel class="sr-only"> Server size </RadioGroupLabel>
        <div class="space-y-4">
            <RadioGroupOption
                as="template"
                v-for="address in addresses"
                :key="address.name"
                :value="address.id"
                v-slot="{ checked, active }"
            >
                <div
                    :class="[
                        checked ? 'border-transparent' : 'border-gray-300',
                        active ? 'ring-2 ring-blue-500' : '',
                        'relative block bg-white border rounded-lg shadow-sm px-6 py-4 cursor-pointer sm:flex  focus:outline-none',
                    ]"
                >
                    <div class="flex">
                        <span
                            :class="[
                                checked
                                    ? 'bg-blue-600 border-transparent'
                                    : 'bg-white border-gray-300',
                                active
                                    ? 'ring-2 ring-offset-2 ring-blue-500'
                                    : '',
                                'h-4 w-4 rounded-full border flex items-center justify-center absolute top-0 right-0 mt-2 mr-2 ',
                            ]"
                            aria-hidden="true"
                        >
                            <span class="rounded-full bg-white w-1.5 h-1.5" />
                        </span>
                    </div>
                    <div class="flex">
                        <div class="text-sm">
                            <RadioGroupLabel
                                class="font-semibold text-blue-500"
                            >
                                <div class="flex items-center gap-1 -ml-1 mb-1">
                                    <HomeIcon
                                        class="w-5 h-5"
                                        v-if="address.is_default"
                                    />
                                    <MapPinIcon class="w-5 h-5" v-else />
                                </div>
                            </RadioGroupLabel>
                            <RadioGroupDescription
                                as="div"
                                class="text-gray-500"
                            >
                                <p class="sm:inline">
                                    {{ address.first_line_address }}
                                </p>
                                {{ " " }}
                                <span
                                    class="hidden sm:inline sm:mx-1"
                                    aria-hidden="true"
                                    >&middot;</span
                                >
                                {{ " " }}
                                <p class="sm:inline">
                                    {{ address.second_line_address }}
                                </p>
                                <p>
                                    {{ address.city }}, {{ address.state }}
                                    {{ address.postcode }}
                                </p>
                            </RadioGroupDescription>
                        </div>
                    </div>

                    <div
                        :class="[
                            active ? 'border' : 'border-2',
                            checked ? 'border-blue-500' : 'border-transparent',
                            'absolute -inset-px rounded-lg pointer-events-none',
                        ]"
                        aria-hidden="true"
                    />
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>
<script setup lang="ts">
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";
import { HomeIcon, MapPinIcon } from "@heroicons/vue/24/solid";
import { useVModel } from "@vueuse/core";
interface Props {
    addresses: Array<App.Models.Address>;
    modelValue: App.Models.Address;
}
interface Emits {
    (event: "update:modelValue", payload: App.Models.Address): boolean;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const selected = useVModel(props, "modelValue", emits);
</script>
