import {request} from "../utils/request";

export default {

    namespaced: true,

    state() {
        return {
        }
    },
    mutations: {
    },
    actions: {
        storeVolumePumpRecord(ctx, payload) {
            return request("/api/set-volume-pump-record", {
                method: "POST",
                body: payload
            })
        }
    },
    getters: {

    }
}
