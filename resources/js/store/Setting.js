import {request} from "../utils/request";

export default {

    namespaced: true,

    state() {
        return {
            options: {},
        }
    },
    mutations: {
        updateSetting(state, value)
        {
            state.options = value;
        },
        updateSettingValue(state, payload = {code: null, value: null})
        {
            state.options[payload.code] = payload.value;
        }
    },
    actions: {
        fetchSetting() {
            return request("/api/setting");
        },
        putSettingValue(ctx, payload) {
            return request(`/api/setting`, {
                method: "POST",
                body: payload
            });
        }
    },
    getters: {

    }
}
