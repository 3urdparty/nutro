<script setup lang="ts">
import { createReusableTemplate } from "@vueuse/core";
import { onMounted, ref } from "vue";
interface Props {
    modelValue: String;
    placeholder?: string;
    inputClass?: string;
    error?: boolean;
}
interface Emits {
    (e: "update:modelValue", value: string): void;
}
const props = defineProps<Props>();
const emits = defineEmits<Emits>();

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
defineOptions({ name: "TextInput", inheritAttrs: true });

const [DefineTemplate, ReuseTemplate] = createReusableTemplate();
</script>

<template>
    <label
        class="text-input border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded focus-within:ring-2 focus-within:ring-offset-0 focus-within:z-10 ring-blue-600 shadow-sm border focus:border-blue-300 transition w-full overflow-clip p-0 m-0"
        :class="[error ? 'border-red-500' : '']"
        :for="($attrs.name as string)"
    >
        <slot name="label" />

        <!-- TODO: Remove top padding visible when autofill is done -->
        <input
            ref="input"
            type="text"
            :placeholder="placeholder"
            v-bind="$attrs"
            class="placeholder:text-slate-400 focus:placeholder:text-slate-300 border-none focus:ring-0 pr-0"
            :class="[$slots.label ? 'py-0 pb-1' : '', inputClass]"
            :value="props.modelValue"
            @input="
                $emit(
                    'update:modelValue',
                    ($event.target as HTMLInputElement).value
                )
            "
        />
        <!-- <ReuseTemplate /> -->
    </label>

    <!-- <ReuseTemplate v-else /> -->

    <!-- <slot /> -->
</template>
