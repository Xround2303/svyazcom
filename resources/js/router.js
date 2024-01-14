import { createWebHistory, createRouter } from "vue-router";
import store from "./store"
import Home from  "./component/page/Home.vue";
import Empty from "./component/page/Empty.vue";
import LayoutDefault from "./component/layout/LayoutDefault.vue";
import LayoutEmpty from "./component/layout/LayoutEmpty.vue";

const route = function (name, path, component, layout = LayoutDefault) {
    return {
        name: name,
        path: path,
        component: component,
        meta: {
            layout: layout
        },
    }
}

const routes = [
    route("404", "/:pathMatch(.*)*", Empty, LayoutEmpty),
    route("index", "/", Home),
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    next()
})

export default router;
