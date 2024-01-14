<template>
    <Toast ref="refToast" />
    <div class="mb-3 text-2xl font-bold">
        Тариф на определенный месяц
    </div>
    <div class="flex mb-10">
        <div>
            <div class="mb-2">Месяц</div>
            <Calendar view="month" v-model="calendar" dateFormat="mm/yy" />
        </div>
        <div class="ml-3">
            <div class="mb-2">Сумма</div>
            <InputNumber v-model="price" />
        </div>
        <Button label="Добавить" class="ml-3 mt-auto" @click="onCreateTariff" />
    </div>
    <div>
        <DataTable :value="periodTariffList" tableStyle="min-width: 50rem" editMode="row" dataKey="id">
            <Column field="id" header="ID" />
            <Column field="period" header="Период">
                <template #body="slotProps">
                    {{slotProps.data.date_period_start}} - {{slotProps.data.date_period_end}}
                </template>
            </Column>
            <Column field="amount" header="Тариф" />
            <Column :exportable="false" style="width: 100px">
                <template #body="slotProps">
                    <Button icon="pi pi-trash" outlined rounded severity="danger" @click="onConfirmDeleteTariff(slotProps.data)" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>
<script setup>
import Calendar from 'primevue/calendar';
import InputNumber from 'primevue/inputnumber';
import Button from "primevue/button";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Toast from "../ui/Toast.vue";

const store = useStore();
const periodTariffList = computed(() => store.state.periodTariff.list);

const refToast = ref(null);
const calendar = ref(null);
const price = ref(null);

const resetForm = function () {
    calendar.value = null;
    price.value = null;
}
const loadPeriodTariffList = function () {
    store.dispatch("periodTariff/fetchPeriodTariffList").then(e => {
        store.commit("periodTariff/updateList", e);
    })
}
const dateFormat = computed(() => {

    if(!calendar.value) {
        return false;
    }

    const date = new Date(calendar.value);
    const options = { year: 'numeric', month: 'long' };
    return date.toLocaleString('en-US', options);
});

const onCreateTariff = function () {

    const formData = new FormData();

    if(price.value) {
        formData.append("price", price.value)
    }

    if(dateFormat.value) {
        formData.append("date", dateFormat.value)
    }


    store.dispatch("periodTariff/store", formData)
        .then(e => {
            refToast.value.show("success", "Успех", "Тариф добавлен");
            resetForm()
            loadPeriodTariffList()
        })
        .catch(e => {
            refToast.value.show("error", "Ошибка", e.message)
        })
}

const onConfirmDeleteTariff = function (periodTariff) {
    if(confirm("Вы действительно хотите удалить выбранный тариф?")) {
        store.dispatch("periodTariff/deletePeriodTariff", periodTariff.id);
        store.commit("periodTariff/removeItemFromList", periodTariff);
    }
}

loadPeriodTariffList();

</script>
<style>
</style>
