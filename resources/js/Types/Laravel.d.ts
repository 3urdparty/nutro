import type { ErrorBag, Errors, Page, PageProps } from "@inertiajs/core";
import routeFn from "ziggy-js";
interface Flash {
    banner: string;
    bannerStyle: "success" | "danger" | "warning" | "info";
    type: "flash" | "activity";
    link?: string;
    linkHref?: string;
    image_url?: string;
    image_url?: string;
    quantity?: number;
    food_item?: string;
}

interface SocialstreamPageProps extends Page<PageProps> {
    socialstream: {
        show: boolean;
        prompt: string;
        providers: {
            name: string;
            icon: string;
            url: string;
        }[];
        hasPassword: boolean;
        connectedAccounts: {
            provider: string;
            provider_name: string;
            provider_id: string;
        }[];
    };

    auth: {
        user: App.Models.User | null;
        two_factor_enabled: boolean;
    };
    errorBags: {
        [key: string]: ErrorBag;
    };
    errors: Errors & ErrorBag;
    cart: {
        items: App.Models.FoodItem[];
        count: number;
    } | null;

    jetstream: {
        canCreateTeams: boolean;
        canManageTwoFactorAuthentication: boolean;
        canUpdatePassword: boolean;
        canUpdateProfileInformation: boolean;
        hasEmailVerification: boolean;
        hasAccountDeletionFeatures: boolean;
        hasApiFeatures: boolean;
        hasTeamFeatures: boolean;
        hasTermsAndPrivacyPolicyFeature: boolean;
        managesProfilePhotos: boolean;
        flash: Flash[];
    };

    [key: string]: any;
}
interface Grouped<T> {
    [key: string]: T[];
}

interface Paginated<T> {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: {
        active: boolean;
        label: string;
        url: string | null;
    }[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

declare global {
    var route: typeof routeFn;

    interface Window extends globalThis {
        _asset: string;
        route: typeof routeFn;
    }

   
}


// TODO:Formalize this and make it not a hack
// Make it so that the parts that are consistent with Jetstream and Socialstream are in seperate layers
// and the custom ones are in the top layer
declare module "@vue/runtime-core" {
    interface ComponentCustomProperties {
        route: typeof routeFn;
        $page: PageProps;
        $page: {
            props: SocialstreamPageProps;
        };
    }

    export interface Page<SharedProps extends PageProps = PageProps> {
        component: string;
        props: SocialstreamPageProps;
        url: string;
        version: string | null;

        scrollRegions: Array<{
            top: number;
            left: number;
        }>;

        rememberedState: Record<string, unknown>;
    }
}
