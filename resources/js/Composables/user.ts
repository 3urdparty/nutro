import type { SocialstreamPageProps } from "@/Types/Laravel";
import { usePage } from "@inertiajs/inertia-vue3";
import { router } from "@inertiajs/vue3";
import { createSharedComposable } from "@vueuse/core";
import { computed } from "vue";

export type Role = "admin" | "customer" | "delivery-person" | "vendor";
export const useUser = createSharedComposable(() => {
    const page = usePage<SocialstreamPageProps>();
    const user = computed(() => page.props.value.auth.user);
    const loggedIn = computed(() => !!user.value);
    const role = computed({
        get: () => user.value?.role,
        set: (value) => {
            //@ts-ignore
            router.get(route("switch-role", { role: value.value }));
        },
    });

    const is = (r: Role) => role.value === r;

    return {
        loggedIn,
        user,
        role,
        is,
    };
});
