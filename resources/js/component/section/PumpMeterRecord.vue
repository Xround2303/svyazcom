<template>
    <Toast ref="refToast" />
    <div class="mb-3">
        Укажите м<sup>3</sup> за предыдущий месяц
    </div>
    <div class="flex">
        <InputNumber v-model="volume" />
        <Button
            label="Добавить"
            class="ml-3"
            :disabled="!settingPumpRecordEnabled"
            @click="onSetVolume"
            :loading="isLoadRequest"
        />
    </div>
    <div class="mt-3 text-gray-300">
        Указывать показания счетчка можно только раз за предыдущий месяц
    </div>
</template>
<script setup>
import InputNumber from 'primevue/inputnumber';
import Button from "primevue/button";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import Toast from "../ui/Toast.vue";

const store = useStore();
const volume = ref(null);
const isLoadRequest = ref(false);
const refToast = ref(null);

const settingPumpRecordEnabled = computed(() => store.state.setting.options.pump_record_enabled);

const prepareFormData = () => {
    const formData = new FormData;
    formData.append("volume", volume.value)
    return formData;
}

const onSetVolume = async () => {
    if(!confirm("Вы уверены что хотите внести, повторно задать будет невозможно!")) {
        return false;
    }

    isLoadRequest.value = true;
    await store.dispatch("pumpMeterRecords/storeVolumePumpRecord", prepareFormData())
        .catch(e => refToast.value.show("error", "Ошибка", e.message))
        .then(e => {
            store.commit("setting/updateSettingValue", {
                code: "pump_record_enabled",
                value: false
            })

            store.dispatch("bill/fetchBillList").then(e => {
                store.commit("bill/updateList", e);
            })
        })
    isLoadRequest.value = false;
}

</script>
<style>
</style>
