<template>
    <Toast ref="refToast" />
    <ResidentFormCreateButton />

    <DataTable :value="residents" tableStyle="min-width: 50rem" editMode="row" dataKey="id">
        <Column field="id" header="ID" />
        <Column field="fio" header="ФИО" />
        <Column field="area" header="Площадь" />
        <Column :exportable="false" style="width: 100px">
            <template #body="slotProps">
                <div class="flex">
                    <Button icon="pi pi-pencil" class="mr-5" outlined rounded severity="danger" @click="onOpenEditDialog(slotProps.data)" />
                    <Button icon="pi pi-trash" outlined rounded severity="danger" @click="confirmDeleteProduct(slotProps.data)" />
                </div>
            </template>
        </Column>
    </DataTable>
    <Dialog v-model:visible="dialogEditVisible" modal header="Edit Profile" :style="{ width: '25rem' }">
        <div class="mb-3">
            <InputText v-model="editFieldResident.fio" class="w-full" />
        </div>
        <div class="mb-3">
            <InputNumber  v-model="editFieldResident.area" class="w-full" />
        </div>

        <div class="flex justify-content-end gap-2">
            <Button type="button" label="Save" @click="onEditSave(editFieldResident)"></Button>
        </div>
    </Dialog>
</template>
<script setup>
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {ref, computed} from 'vue';
import ResidentFormCreateButton from "./ResidentFormCreateButton.vue";
import {useStore} from "vuex";
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Toast from "../ui/Toast.vue";

const store = useStore();
const residents = computed(() => store.state.resident.list);
const dialogEditVisible = ref(false);
const refToast = ref(null);

const editFieldResident = ref(null);

store.dispatch("resident/fetchResidentList").then(e => {
    store.commit("resident/updateList", e);
})

const confirmDeleteProduct = (resident) => {
    if(!confirm("Вы действительно хотите удалить клиента?")) {
        return false;
    }

    store.commit("resident/removeResidentFromList", resident);
    store.dispatch("resident/deleteResident", resident.id);
};

const onOpenEditDialog = function (data) {
    editFieldResident.value = data;
    dialogEditVisible.value = true;
}

const onEditSave = function (editFieldResident) {

    const formData = new FormData;

    formData.append("fio", editFieldResident.fio)
    formData.append("area", editFieldResident.area)

    store.dispatch("resident/updateResident", {
        id: editFieldResident.id,
        formData
    })
        .then(e => dialogEditVisible.value = false)
        .catch(e => {
            refToast.value.show("error", "Ошибка", e.message)
        })
}


</script>
<style>
</style>
