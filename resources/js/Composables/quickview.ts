import { createGlobalState } from "@vueuse/core";
import { ref } from "vue";

export const useQuickView = createGlobalState(() => {
    const showQuickView = ref(false);

    const hide = () => {
        showQuickView.value = false;
    };
    const show = (i:App.Models.FoodItem) => {
        item.value = i;
        showQuickView.value = true;
    }
    const item = ref<App.Models.FoodItem | null>();
    const setCurrentItem = (i: App.Models.FoodItem) => {
        item.value = i;
        showQuickView.value = true;
    };
    return { showQuickView, hide, item, setCurrentItem, show };
});
