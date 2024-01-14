import {createStore} from "vuex";
import Resident from "./store/Resident";
import PumpMeterRecords from "./store/PumpMeterRecords";
import Bill from "./store/Bill";
import Setting from "./store/Setting";
import PeriodTariff from "./store/PeriodTariff";
import {request} from "./utils/request";

export default createStore({
    modules: {
        resident: Resident,
        pumpMeterRecords: PumpMeterRecords,
        bill: Bill,
        setting: Setting,
        periodTariff: PeriodTariff
    },
    state() {
        return {
        }
    },
    mutations: {
    },
    actions: {
    },
    getters: {
    }
})
