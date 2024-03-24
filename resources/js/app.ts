import "../css/app.css";
import "./bootstrap";

import Button from "@/Components/Button.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faBowlRice,
    faBreadSlice,
    faCarrot,
    faFilter,
    faShrimp,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { MotionPlugin } from "@vueuse/motion";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Image from "./Components/Image.vue";

library.add(faFilter, faCarrot, faBreadSlice, faShrimp, faBowlRice);

// Progress bar
InertiaProgress.init({
    delay: 0,
    color: "#42A0ED",
    includeCSS: true,
    showSpinner: true,
});
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        //@ts-ignore
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    //@ts-ignore
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)

            .use(MotionPlugin)
            .component("Button", Button)
            .component("Image", Image)
            .mixin({
                methods: {
                    route: window.route,
                    asset(path: string) {
                        var base_path = window._asset || "";
                        return base_path + path;
                    },
                },
            })
            .component("FontAwesomeIcon", FontAwesomeIcon)
            .mount(el);
    },
});
