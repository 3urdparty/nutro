import { useCssVar, useWindowScroll } from "@vueuse/core";
import { watch } from "vue";

export const useBackground = () => {
    const { y } = useWindowScroll();
    const background = useCssVar("--bg-color");
    watch(y, () => {
        if (y.value > 20) background.value = "rgb(31 41 55)";
        else background.value = "rgb(29 78 216)";
    });
};
