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
        }
    },
    actions: {
        fetchBillList(ctx, date) {
            let url = `/api/bills`;

            if(date) {
                const object = {
                    date: date
                }
                const queryParams = new URLSearchParams(object).toString();
                url += `?${queryParams}`;
            }

            return request(url)

        }
    },
    getters: {

    }
}
