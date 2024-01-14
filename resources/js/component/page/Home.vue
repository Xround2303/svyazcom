<template>
    <TabView :activeIndex="2">
        <TabPanel header="Показания">
            <PumpMeterRecord />
        </TabPanel>
        <TabPanel header="Тариф">
            <Tariffs />
        </TabPanel>
        <TabPanel header="Клиенты">
            <ResidentList />
        </TabPanel>
        <TabPanel header="Счета">
            <BillList />
        </TabPanel>
    </TabView>
</template>
<script setup>
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import ResidentList from "../section/ResidentList.vue";
import PumpMeterRecord from "../section/PumpMeterRecord.vue";
import BillList from "../section/BillList.vue";
import Tariffs from "../section/Tariffs.vue";
</script>
<style>
</style>
