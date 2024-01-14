import {createApp} from "vue";
import "./assets/css/main.css";
import store from "./store";
import router from "./router";
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/lara-light-green/theme.css'
import Index from  "./component/page/Index.vue";
import 'primeicons/primeicons.css'

store.dispatch("setting/fetchSetting").then(e => {

    store.commit("setting/updateSetting", e);

    createApp(Index)
        .use(router)
        .use(store)
        .use(PrimeVue)
        .use(ToastService)
        .mount('#app');
})



