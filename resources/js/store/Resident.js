import {request} from "../utils/request";

export default {

    namespaced: true,

    state() {
        return {
            list: [],
        }
    },
    mutations: {
        updateList(state, value)
        {
            state.list = value;
        },
        removeResidentFromList(state, resident)
        {
            state.list.splice(state.list.indexOf(resident), 1);
        }
    },
    actions: {
        fetchResidentList() {
            return request("/api/resident");
        },
        storeResident(ctx, payload) {
            return request("/api/resident", {
                method: "POST",
                body: payload
            })
        },
        deleteResident(ctx, id) {
            return request(`/api/resident/${id}`, {
                method: "DELETE"
            })
        },
        updateResident(ctx, payload = {id: null, formData: null}) {
            payload.formData.append("_method", "PUT")
            return request(`/api/resident/${payload.id}`, {
                method: "POST",
                body: payload.formData
            })
        }
    },
    getters: {

    }
}
