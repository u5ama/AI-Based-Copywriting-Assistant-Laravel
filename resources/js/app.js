require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { library } from "@fortawesome/fontawesome-svg-core";
import { faHome, faUser, faKey, faSignOut, faMoneyBill, faPlus, faEdit, faTrash, faCopy, faSyncAlt, faEye, faEyeSlash, faFlag } from "@fortawesome/free-solid-svg-icons";

library.add(faHome,faUser, faKey, faSignOut, faMoneyBill, faPlus, faEdit, faTrash, faCopy, faSyncAlt, faEye, faEyeSlash, faFlag);
/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import Toast  from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toast)
            .mixin({ methods: { route } })
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
