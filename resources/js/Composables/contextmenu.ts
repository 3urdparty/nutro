import { createSharedComposable } from "@vueuse/core";
import { computed, ref, type Component } from "vue";

export type MenuOption = {
    icon?:string | Component;
    label: string;
    submenu?: MenuOption[];
    severity?: "danger" | "warning" | "info" | "success";
    action: () => void;
};
export const useContextMenu = createSharedComposable(() => {
    const show = ref(false);
    const options = ref<MenuOption[]>([]);
    const x = ref(0);
    const y = ref(0);

    const open = (event: MouseEvent) => {
        event.preventDefault();
        y.value = event.clientY;
        x.value = event.clientX;
        show.value = true;
    };

    const close = () => {
        show.value = false;
    };

    addEventListener("click", close);

    const style = computed(() => ({
        top: `${y.value}px`,
        left: `${x.value}px`,
    }));

    const setOptions = (newOptions: MenuOption[]) => {
        options.value = newOptions;
    };

    return {
        open,
        close,
        show,
        x,
        y,
        style,
        options,
        setOptions,
    };
});
