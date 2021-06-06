<template>
    <div class="grid grid-cols-12 content-header mb-5">
        <div class="content-header-left col-span-9">
            <h2>Enseignants</h2>
        </div>
        <div class="content-header-right col-span-3 justify-self-end">
            <inertia-link :href="route('teacher.add')" as="button"
                          class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600"
                          method="get"
                          type="button">
                Nouveau enseignant
            </inertia-link>
        </div>
    </div>
    <div class="card p-6">
        <DataTable :sortOrder="1" :value="teachers" groupRowsBy="subject.name"
                   responsiveLayout="scroll" rowGroupMode="subheader" sortField="subject.name" sortOrder="1" scrollable scrollHeight="65vh" class=""
                   :loading="loading1" v-model:filters="filters1" :globalFilterFields="['first_anme', 'last_anme', 'dob', 'qualification','subject.name']"
                   :paginator="true" :rows="10"
        >
            <template #header>
                <div class="flex justify-end">
                    <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <input class="form-control" style="padding-left: 30px;" type="text" v-model="filters1['global'].value" placeholder="Keyword Search" />
                        </span>
                </div>
            </template>
            <Column field="subject.name" header="Matière"></Column>
            <template #groupheader="slotProps">
                <img :alt="slotProps.data.subject.name" :src="slotProps.data.subject.image_path" width="32" style="vertical-align: middle" />
                <span class="image-text">{{slotProps.data.subject.name}}</span>
            </template>
            <Column header="#" headerStyle="width:3em">
                <template #body="slotProps">
                    {{ slotProps.index }}
                </template>
            </Column>
            <Column field="last_name" header="Nom"></Column>
            <Column field="first_name" header="Prénom"></Column>
            <Column field="dob" header="Date de naissaince">
                <template #body="slotProps">
                    {{ formatDate(slotProps.data.dob) }}
                </template>
            </Column>
            <Column field="qualification" header="Qualification">
            </Column>
            <Column :exportable="false">
                <template #body="slotProps">
                    <inertia-link :data="{ id: slotProps.data.id }" :href="route('class.edit')" as="button"
                                  class="bg-primary-500 text-white  rounded-full w-10 h-10 font-medium inline-flex justify-center items-center mr-4 border border-primary-500 hover:ring-4 hover:ring-primary-100 focus:bg-primary-600 focus:outline-none active:bg-primary-600"
                                  method="get" title="Edit"
                                  type="button">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                    </inertia-link>
                    <button
                        class="bg-danger-500 text-white rounded-full w-10 h-10 font-medium p-0 inline-flex justify-center items-center border border-danger-500 hover:ring-4 hover:ring-danger-200 focus:bg-danger-800 focus:outline-none active:bg-danger-800"
                        title="Delete">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </button>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {FilterMatchMode,FilterOperator} from 'primevue/api';
import { ref  } from 'vue';

export default {
    components: {DataTable, Column},
    name: "Index",
    layout: DashLayout,
    props: {
        teachers: Array,
    },
    setup(props){
        const filters1 = ref({
            'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
            'first_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
            'last_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
            'qualification':{operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
            'dob': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
            'subject.anme': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
        });
        const loading1 = ref(false);
        const clearFilter1 = () => {
            initFilters1();
        };
        const initFilters1 = () => {
            filters1.value = {
                'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'first_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                'last_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                'qualification':{operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
                'dob': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
                'subject.anme': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                 }
        };

        return { filters1,loading1, clearFilter1, initFilters1}
    },
}
</script>

<style lang="scss"  scoped>
.p-rowgroup-footer td {
    font-weight: 700;
}

::v-deep(.p-rowgroup-header) {
    span {
        font-weight: 700;
    }
    .p-row-toggler {
        vertical-align: middle;
        margin-right: .25rem;
    }
}
</style>
