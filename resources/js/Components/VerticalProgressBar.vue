<template>
    <div class="py-1 pb-3 pl-1">
        <div
            class="bg-slate-200 rounded-full"
            :style="{
                height: orientation === 'horizontal' ? '5px' : total + 'px',
                width: orientation === 'vertical' ? '5px' : total + 'px',
            }"
        >
            <div
                class="relative top-px"
                :style="{
                    left: orientation === 'horizontal' ? '40px' : '0px',
                    width:
                        orientation === 'horizontal'
                            ? completion + 'px'
                            : '5px',
                    height:
                        orientation === 'vertical' ? completion + 'px' : '5px',
                }"
            >
                <!-- Marker -->
                <slot />
                <div
                    class="w-full h-full bg-blue-500 absolute top-1/2 transform -translate-y-1/2 left-0"
                />
                <div
                    class="absolute left-0 top-2 -ml-2 text-slate-500 font-medium text-sm"
                >
                    {{ start }}
                </div>

                <div
                    class="w-3 h-3 bg-slate-600 rounded-full absolute transform"
                    :class="{
                        'right-0 top-1/2': orientation === 'horizontal',
                        '-left-[3.25px] -top-2': orientation === 'vertical',
                    }"
                />
                <div
                    class="w-3 h-3 bg-blue-100 rounded-full absolute transform border-2 border-slate-500"
                    :class="{
                        'right-0 bottom-1/2': orientation === 'horizontal',
                        '-left-[3.25px] -bottom-2': orientation === 'vertical',
                    }"
                />
                <div
                    class="absolute right-0 top-2 -mr-3 text-slate-500 font-medium text-sm"
                >
                    {{ end }}
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="tsx">
import { computed } from "vue";

export type Orientation = "horizontal" | "vertical";
interface Props {
    orientation?: Orientation;
    value?: number;
    total?: number;
    start?: string;
    end?: string;
}

const props = withDefaults(defineProps<Props>(), {
    orientation: "horizontal",
    value: 20,
    total: 100,
});

const completion = computed(() => (props.value / props.total) * 100);
</script>
