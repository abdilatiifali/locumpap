require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { Link } from "@inertiajs/inertia-vue3";
import SiteLayout from "@/shared/SiteLayout";

InertiaProgress.init();

createInertiaApp({
    resolve: (name) => {
        let page = require(`./Pages/${name}`).default;

        page.layout ??= SiteLayout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .mount(el);
    },
});
