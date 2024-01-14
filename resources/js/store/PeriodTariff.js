import {request} from "../utils/request";

export default {

    namespaced: true,

    state() {
        return {
            list: []
        }
    },
    mutations: {
        updateList(state, value) {
            state.list = value;
        },
        removeItemFromList(state, item)
        {
            state.list.splice(state.list.indexOf(item), 1);
        }
    },
    actions: {
        fetchPeriodTariffList(state, paylaod) {
            return request("/api/tariff");
        },
        deletePeriodTariff(ctx, id) {
            return request(`/api/tariff/${id}`, {
                method: "DELETE"
            })
        },
        store(ctx, payload) {
            return request("/api/tariff", {
                method: "POST",
                body: payload
            })
        },
    },
    getters: {

    }
}
