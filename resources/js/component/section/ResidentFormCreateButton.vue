<template>
    <Toast ref="refToast" />
    <Button label="Добавить" class="mb-5" @click="visibleDialog = true" />
    <Dialog v-model:visible="visibleDialog" modal header="Добавить клиента" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
        <Toast ref="refToast" />
        <div class="flex flex-col">
            <div class="mb-3">
                <div class="mb-2">ФИО</div>
                <InputText v-model="fio" type="text" class="w-full" />
            </div>
            <div class="mb-5">
                <div class="mb-2">Площадь</div>
                <InputNumber v-model="area" type="text" :min="0" :max="999" class="w-full" />
            </div>
            <Button label="Добавить" class="ml-auto" :loading="isLoadRequest" @click="onStoreResident" />
        </div>
    </Dialog>
</template>
<script setup>
import Dialog from 'primevue/dialog';
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import {ref} from "vue";
import {useStore} from "vuex";
import Toast from "../ui/Toast.vue";
import InputNumber from 'primevue/inputnumber';

const refToast = ref(null);
const visibleDialog = ref(false);
const store = useStore();
const fio = ref(null);
const area = ref(null);
const isLoadRequest = ref(false);

const prepareFormData = function () {
    const formData = new FormData();

    formData.append("fio", fio.value);
    formData.append("area", area.value);

    return formData;
}

const resetForm = function () {
    fio.value = null;
    area.value = null;
}

const onStoreResident = async () => {
    isLoadRequest.value = true;
    await store.dispatch("resident/storeResident", prepareFormData())
        .then(e => {
            store.dispatch("resident/fetchResidentList").then(e => {
                store.commit("resident/updateList", e);
            })

            refToast.value.show("success", "Успех", "Клиент добавлен")
            resetForm();
            visibleDialog.value = false;
        })
        .catch(e => {
            refToast.value.show("error", "Ошибка", e.message)
        });

    isLoadRequest.value = false;
}
</script>
<style>
</style>
