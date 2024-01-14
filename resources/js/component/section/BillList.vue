<template>
    <div class="flex mb-5">
        <div class="flex flex-col">
            <div class="mb-3">Выберите месяц для фильтрации списка</div>
            <Calendar v-model="calendarValue"  view="month" dateFormat="mm/yy" />
        </div>
        <Button label="Поиск" class="ml-3 mt-auto" :disabled="!calendarValue" @click="onSearch" />
        <Button label="Показать все" class="ml-3 mt-auto" @click="onSearchAndReset" />
    </div>

    <DataTable :value="billList" tableStyle="min-width: 50rem" editMode="row" dataKey="id">
        <Column field="id" header="ID"></Column>
        <Column field="fio" header="ФИО" />
        <Column field="area" header="Площадь" />
        <Column field="cost" header="Сумма для оплаты" />
        <Column field="period" header="Период">
            <template #body="slotProps">
                {{slotProps.data.date_period_start}} - {{slotProps.data.date_period_end}}
            </template>
        </Column>
    </DataTable>
</template>
<script setup>
import Calendar from 'primevue/calendar';

import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {ref, computed} from 'vue';
import {useStore} from "vuex";

const calendarValue = ref(null);
const store = useStore();
const billList = computed(() => store.state.bill.list);

const dateFormat = computed(() => {

    if(!calendarValue.value) {
        return false;
    }

    const date = new Date(calendarValue.value);
    const options = { year: 'numeric', month: 'long' };
    return date.toLocaleString('en-US', options);
});

const onSearchAndReset = function () {
    calendarValue.value = null;
    onSearch();
}
const onSearch = function () {
    store.dispatch("bill/fetchBillList", dateFormat.value).then(e => {
        store.commit("bill/updateList", e);
    })
}

onSearch();
</script>
<style>
</style>
