// store.js
import type { SocialstreamPageProps } from "@/Types/Laravel";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import { createGlobalState } from "@vueuse/core";
import { computed, ref } from "vue";

interface AddToCartFnOptions {
    onComplete?: () => void;
    onError?: () => void;
    onProgress?: () => void;
    onStart?: () => void;
}
export const useCart = createGlobalState(() => {
    const page = usePage<SocialstreamPageProps>();
    const items = computed(() => page.props.value.cart?.items ?? []);
    const count = computed(() => page.props.value.cart?.count ?? 0);

    const addToCart = (
        id: number,
        quantity: number = 1,
        options?: AddToCartFnOptions
    ) => {
        Inertia.post(
            route("cartItem.store"),
            { food_item_id: id, quantity: quantity },
            {
                preserveScroll: true,
                preserveState: true,
                onFinish: options.onComplete,
                onError: options.onError,
                onProgress: options.onProgress,
                onStart: options.onStart,
            }
        );
    };

    const open = ref(false);
    const show = () => {
        open.value = true;
    };
    const close = () => {
        open.value = false;
    };
    const subtotal = computed(() =>
        items.value.reduce((acc, item) => {
            return acc + item.price * item.quantity;
        }, 0)
    );

    const placeOrder = () => {
        Inertia.visit(route("orders.create"));
    };
    return { addToCart, items, count, show, open, close, subtotal, placeOrder };
});
