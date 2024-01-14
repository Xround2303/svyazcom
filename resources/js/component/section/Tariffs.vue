<template>
    <div>
        <div class="mb-3 text-2xl font-bold">
            Тариф по умолчанию
        </div>
        <div class="mb-3 border-gray-100 border-b-2 pb-5 mb-5">
            <div class="mb-2">Укажите сумма за 1м<sup>3</sup> (руб.)</div>
            <InputNumber :modelValue="+tariffDefault" @input="onInputTariffDefault($event.value)" />
        </div>
    </div>
    <PeriodTariff />
</template>
<script setup>
import InputNumber from 'primevue/inputnumber';
import {computed, ref} from "vue";
import {useStore} from "vuex";
import PeriodTariff from "./PeriodTariff.vue";

const store = useStore();
const tariffDefault = computed(() => store.state.setting.options.tariff_default);
let timeoutRequestInputTariffDefault = null;

const onInputTariffDefault = function (value) {

    store.commit("setting/updateSettingValue", {
        code: "tariff_default",
        value: value
    })

    if(timeoutRequestInputTariffDefault) {
        clearTimeout(timeoutRequestInputTariffDefault);
    }

    timeoutRequestInputTariffDefault = setTimeout(() => {

        const formData = new FormData()
        formData.append("value", value);
        formData.append("code", "tariff_default");

        store.dispatch("setting/putSettingValue", formData)

    }, 500)
}
</script>
<style>
</style>
